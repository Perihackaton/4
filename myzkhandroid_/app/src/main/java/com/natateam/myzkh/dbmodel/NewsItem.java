package com.natateam.myzkh.dbmodel;

import io.realm.RealmObject;

/**
 * Created by macbook on 30/01/ 15.
 */
public class NewsItem  extends RealmObject{
    private String date;
    private String theme;
    private String text;

    public String getDate() {
        return date;
    }

    public String getTheme() {
        return theme;
    }

    public String getText() {
        return text;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public void setTheme(String theme) {
        this.theme = theme;
    }

    public void setText(String text) {
        this.text = text;
    }
}
