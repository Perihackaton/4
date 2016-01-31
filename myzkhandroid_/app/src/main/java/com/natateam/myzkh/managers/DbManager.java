package com.natateam.myzkh.managers;

import android.content.Context;

import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillHistoryItem;
import com.natateam.myzkh.dbmodel.BillService;
import com.natateam.myzkh.dbmodel.NewsItem;
import com.natateam.myzkh.model.OrderItem;

import java.util.ArrayList;
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
            //news
            NewsItem newsItem=realm.createObject(NewsItem.class);
            newsItem.setTheme("Объявление об отключении воды");
            newsItem.setText("В ночь с 03 апреля на 04 февраля 2016 г. с 00.00 до 03.00 будет произведено отключение холодного и горячего водоснабжения в связи с ремонтными работами");
            newsItem.setDate("20.02.2016");
            newsItem=realm.createObject(NewsItem.class);
            newsItem.setTheme("СОБСТВЕННИКАМ ЖИЛЬЯ В ДАГЕСТАНЕ ПРОДЛИЛИ СРОКИ ДЛЯ УПЛАТЫ ВЗНОСОВ НА КАПРЕМОНТ ИСТОЧНИК");
            newsItem.setText("Согласно тексту Закона «О внесении изменений в Закон Республики Дагестан «Об организации проведения капитального ремонта " +
                    "общего имущества в многоквартирных домах в Республике Дагестан», в документ включено положение о проведении капремонта в подъездах.");
            newsItem.setDate("25.12.2015");

            //orders
            OrderItem orderItem=realm.createObject(OrderItem.class);
            orderItem.setTheme("Заявка на ремонт канализации");
            orderItem.setAdress("г. Махачкала. Ул. Гамидова 55.");
            orderItem.setPercent(75);

            orderItem=realm.createObject(OrderItem.class);
            orderItem.setTheme("Заявка на освещение двора");
            orderItem.setAdress("г. Махачкала. Ул. Титова 39.");
            orderItem.setPercent(25);


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
                billHistoryItem.setDate(Long.toString(System.currentTimeMillis()));
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

    public RealmResults<NewsItem> getAllNews(){
        RealmQuery<NewsItem> query=realm.where(NewsItem.class);
        return query.findAll();
    }

    public RealmResults<OrderItem> getAllOrders(){
        RealmQuery<OrderItem> query=realm.where(OrderItem.class);
        return query.findAll();
    }
    public void updateBills(String bills){
        realm.beginTransaction();
        realm.clear(Bill.class);
        realm.createAllFromJson(Bill.class,bills);
        realm.commitTransaction();
    }

    public void updateHistory(String history,String bill){
        realm.beginTransaction();
        RealmResults<BillHistoryItem> historyItems=getHistoryItemsForBill(bill);
        if (historyItems!=null) {
            historyItems.clear();
        }
        realm.createAllFromJson(BillHistoryItem.class, history);
        realm.commitTransaction();

    }



}
