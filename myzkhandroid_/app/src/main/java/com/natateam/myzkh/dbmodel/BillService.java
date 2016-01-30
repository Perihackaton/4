package com.natateam.myzkh.dbmodel;

import io.realm.RealmObject;

/**
 * Created by macbook on 30/01/ 15.
 */
public class BillService extends RealmObject {
    private int service_id;
    private String name;

    public void setTarrif(double tarrif) {
        this.tarrif = tarrif;
    }

    private double tarrif=18.2;
    public static final int BILL_1=1;
    public static final int BILL_2=2;
    public static final int BILL_3=3;
    public static final int BILL_4=4;
    public static final int BILL_5=5;
    public static final int BILL_6=6;
    public static final int BILL_7=7;
    public static final int BILL_8=8;
    public static final int BILL_9=9;



    public void setService_id(int service_id) {
        this.service_id = service_id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getService_id() {
        return service_id;
    }

    public String getName() {
        return name;
    }

    public double getTarrif() {
        return tarrif;
    }
}
