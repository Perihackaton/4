package com.natateam.myzkh.managers;

import android.content.Context;

import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillHistoryItem;
import com.natateam.myzkh.dbmodel.BillService;

import java.util.Random;

import io.realm.Realm;
import io.realm.RealmQuery;
import io.realm.RealmResults;

/**
 * Created by macbook on 30/01/ 15.
 */
public class DbManager {
    private static DbManager _singletone;
    private Context mContext;
    private String[] zkh_list;
    private Realm realm;
    public DbManager(Context context){
        realm=Realm.getInstance(context);
        mContext=context;
        zkh_list=mContext.getResources().getStringArray(R.array.zkh_list);
        setZkhData();
    }

    public static DbManager getInstanse(){
        if (_singletone==null){
            _singletone= new DbManager(ZkhApp.getInstanse().getApplicationContext());
        }
        return _singletone;
    }


    public void setZkhData(){
        if (SharedManager.getInstase().isDBTestempty()){
            realm.beginTransaction();
            for (int i=0;i<zkh_list.length;i++){
                BillService billService= realm.createObject(BillService.class);
                billService.setName(zkh_list[i]);
                billService.setService_id(i+1);
            }
            realm.commitTransaction();
            SharedManager.getInstase().setIsDbTestEmpty(false);
        }
    }

    public RealmResults<BillService> getAllServices(){
        RealmQuery<BillService> query = realm.where(BillService.class);
        return  query.findAll();
    }

    public Bill getBillByBillService(long service_id){
        RealmQuery<Bill> query=realm.where(Bill.class).equalTo("service_id", service_id);
        return query.findFirst();
    }

    public BillService getBillServiceById(long service_id){
        RealmQuery<BillService> query=realm.where(BillService.class).equalTo("service_id",service_id);
        return query.findFirst();
    }

    public void addBill(String billText,int service_id){
        realm.beginTransaction();
        Bill bill=getBillByBillService(service_id);
        Random random= new Random();
        if (bill==null) {
            bill = realm.createObject(Bill.class);
            for (int i=0;i<3;i++){
                BillHistoryItem billHistoryItem=realm.createObject(BillHistoryItem.class);
                billHistoryItem.setBill(billText);
                billHistoryItem.setDate("Ноябрь 2015");
                billHistoryItem.setDept_begin(random.nextInt(10000));
                billHistoryItem.setDept_end(random.nextInt(10000));
                billHistoryItem.setEnrolled(random.nextInt(10000));
                billHistoryItem.setPaid(random.nextInt(10000));
            }
        }
        bill.setBill(billText);
        bill.setService_id(service_id);
        bill.setDept(random.nextInt(10000));
        realm.commitTransaction();
    }

    public RealmResults<BillHistoryItem> getHistoryItemsForBill(String bill){
        RealmQuery<BillHistoryItem> query=realm.where(BillHistoryItem.class).equalTo("bill",bill);
        return query.findAll();
    }



}
