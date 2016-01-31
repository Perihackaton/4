package com.natateam.myzkh.managers;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.text.TextUtils;

import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.model.Profile;

/**
 * Created by macbook on 29/01/ 15.
 */
public class SharedManager {
    private static SharedManager _singletone;
    private Context mContext;
    private SharedPreferences sharedPreferences;
    private SharedPreferences.Editor editor;
    public static final String TOKEN="TOKEN";
    public static final String FIO="FIO";
    public static final String PASS="PASS";
    public static final String STREET="STREET";
    public static final String CORPSE="CORPSE";
    public static final String HOUSE="HOUSE";
    public static final String FLAT="FLAT";
    public static final String CITY="CITY";
    public static final String IS_DB_TEST_EMPTY="IS_DB_TEST_EMPTY";
    public static final String IS_NEED_ADD_BILL="IS_NEED_ADD_BILL";
    public static final String CURRENT_SERVICE_ID="CURRENT_SERVICE_ID";



    public static SharedManager getInstase(){
        if (_singletone==null){
            _singletone= new SharedManager(ZkhApp.getInstanse().getApplicationContext());
        }
        return _singletone;
    }
    public SharedManager(Context context){
        sharedPreferences= PreferenceManager.getDefaultSharedPreferences(context);
        editor=sharedPreferences.edit();
        mContext=context;
    }

    public void saveProfile(Profile profile){
        setCity(profile.city);
        setStreet(profile.street);
        setHouse(profile.house);
        setCorpse(profile.corpse);
        setFio(profile.fio);
        setFlat(profile.flat);
    }

    public String getTOKEN() {
        return sharedPreferences.getString(TOKEN,null);
    }

    public  String getFIO() {
        return sharedPreferences.getString(FIO,null);
    }

    public String getPASS() {
        return sharedPreferences.getString(PASS,null);
    }

    public String getSTREET() {
        return sharedPreferences.getString(STREET,null);
    }

    public String getCORPSE() {
        return sharedPreferences.getString(CORPSE,null);
    }

    public  String getCity() {
        return sharedPreferences.getString(CITY,null);
    }

    public String getFLAT() {
        return sharedPreferences.getString(FLAT,null);
    }

    public String getHouse(){
        return sharedPreferences.getString(HOUSE,null);
    }

    public void setToken(String token){
        editor.putString(TOKEN,token);
        editor.commit();
    }

    public void setFio(String fio){
        editor.putString(FIO,fio);
        editor.commit();
    }

    public void setCity(String fio){
        editor.putString(CITY,fio);
        editor.commit();
    }

    public void setStreet(String fio){
        editor.putString(STREET,fio);
        editor.commit();
    }

    public void setHouse(String fio){
        editor.putString(HOUSE,fio);
        editor.commit();
    }

    public void setFlat(String fio){
        editor.putString(FLAT,fio);
        editor.commit();
    }

    public void setCorpse(String fio){
        editor.putString(CORPSE,fio);
        editor.commit();
    }

    public Profile getProfile(){
        Profile profile= new Profile();
        profile.city=getCity();
        profile.corpse=getCORPSE();
        profile.fio=getFIO();
        profile.token=getTOKEN();
        profile.street=getSTREET();;
        profile.flat=getFLAT();
        profile.house=getHouse();
        return profile;
    }

    public boolean isDBTestempty(){
        return sharedPreferences.getBoolean(IS_DB_TEST_EMPTY,true);
    }

    public void setIsDbTestEmpty(boolean isEmpty){
        editor.putBoolean(IS_DB_TEST_EMPTY,isEmpty);
        editor.commit();
    }

    public boolean isNeedAddBill(){
        return  sharedPreferences.getBoolean(IS_NEED_ADD_BILL,false);

    }
    public void setIsNeedAddBill(boolean isNeed){
        editor.putBoolean(IS_NEED_ADD_BILL,isNeed);
        editor.commit();
    }

    public boolean isProfileFull(){
        Profile profile=getProfile();
        if (TextUtils.isEmpty(profile.city)||TextUtils.isEmpty(profile.street)||
                TextUtils.isEmpty(profile.house)){
            return false;
        }else {
            return true;
        }
    }

    public void setCurrentServiceId(int id){
        editor.putInt(CURRENT_SERVICE_ID,id);
        editor.commit();
    }

    public int getCurrentServiceId(){
        return sharedPreferences.getInt(CURRENT_SERVICE_ID,-1);
    }


}
