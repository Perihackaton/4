package com.natateam.myzkh.model;

import io.realm.RealmObject;

/**
 * Created by macbook on 31/01/ 15.
 */
public class OrderItem extends RealmObject {
    private String photo_url;
    private int percent;
    private String adress;
    private String theme;

    public String getPhoto_url() {
        return photo_url;
    }

    public int getPercent() {
        return percent;
    }

    public String getAdress() {
        return adress;
    }

    public String getTheme() {
        return theme;
    }

    public void setPhoto_url(String photo_url) {
        this.photo_url = photo_url;
    }

    public void setPercent(int percent) {
        this.percent = percent;
    }

    public void setAdress(String adress) {
        this.adress = adress;
    }

    public void setTheme(String theme) {
        this.theme = theme;
    }
}
