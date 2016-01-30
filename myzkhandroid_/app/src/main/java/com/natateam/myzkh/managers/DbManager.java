package com.natateam.myzkh.managers;

import android.content.Context;

import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillService;

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
        }
    }

    public RealmResults<BillService> getAllServices(){
        RealmQuery<BillService> query = realm.where(BillService.class);
        return  query.findAll();
    }

    public Bill getBillByBillService(long service_id){
        RealmQuery<Bill> query=realm.where(Bill.class).equalTo("service_id",service_id);
        return query.findFirst();
    }
}
