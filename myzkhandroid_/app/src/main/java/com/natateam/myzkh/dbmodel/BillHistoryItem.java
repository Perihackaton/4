package com.natateam.myzkh.dbmodel;

import io.realm.RealmObject;

/**
 * Created by macbook on 30/01/ 15.
 */
public class BillHistoryItem extends RealmObject {
    private String bill;
    private String date;
    private  double dept_end;
    private  double dept_begin;
    private  double enrolled;
    private  double paid;

    public String getBill() {
        return bill;
    }

    public String getDate() {
        return date;
    }

    public double getDept_end() {
        return dept_end;
    }

    public double getDept_begin() {
        return dept_begin;
    }

    public double getEnrolled() {
        return enrolled;
    }

    public double getPaid() {
        return paid;
    }

    public void setBill(String bill) {
        this.bill = bill;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public void setDept_end(double dept_end) {
        this.dept_end = dept_end;
    }

    public void setDept_begin(double dept_begin) {
        this.dept_begin = dept_begin;
    }

    public void setEnrolled(double enrolled) {
        this.enrolled = enrolled;
    }

    public void setPaid(double paid) {
        this.paid = paid;
    }
}
