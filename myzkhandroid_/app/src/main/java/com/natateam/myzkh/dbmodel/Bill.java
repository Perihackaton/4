package com.natateam.myzkh.dbmodel;

import io.realm.RealmObject;

/**
 * Created by macbook on 30/01/ 15.
 */
public class Bill extends RealmObject {
    private   long service_id;
    private double dept;
    private String bill;

    public void setService_id(long service_id) {
        this.service_id = service_id;
    }

    public void setDept(double dept) {
        this.dept = dept;
    }

    public void setBill(String bill) {
        this.bill = bill;
    }

    public long getService_id() {
        return service_id;
    }

    public double getDept() {
        return dept;
    }

    public String getBill() {
        return bill;
    }
}
