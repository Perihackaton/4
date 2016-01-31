package com.natateam.myzkh;

import com.android.volley.RequestQueue;
import com.natateam.myzkh.net.AddBillRequest;
import com.natateam.myzkh.net.AuthRequest;
import com.natateam.myzkh.net.GetHistoryRequest;
import com.natateam.myzkh.net.GetProfileRequest;
import com.natateam.myzkh.net.Listener;
import com.natateam.myzkh.net.RegCodeRequest;
import com.natateam.myzkh.net.RegRequest;
import com.natateam.myzkh.net.SaveUserRequest;

import java.io.UnsupportedEncodingException;


/**
 * Created by macbook on 11/03/15.
 */
public class ApiFacade {
    private static volatile ApiFacade _singleton;
    public static ApiFacade getInstance() {
        if (_singleton == null) {
            _singleton = new ApiFacade();
        }
        return _singleton;
    }
    protected RequestQueue getQueue() {
        return ZkhApp.getInstanse().getRequestQueue();
    }

    public void setAuth(String login,String password,Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new AuthRequest(login,password,listener));
    }

    public void setReg(String login, String pass,String fio, Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new RegRequest(login,pass,fio,listener));
    }

    public void setRegBycode(String login, String code, Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new RegCodeRequest(login, code, listener));

    }

    public void saveProfile(String fio,String city, String street,
                            String house, String corpse, String flat, Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new SaveUserRequest(fio, city, street, house, corpse, flat, listener));
    }

    public void addBill(String bill,int service_id, Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new AddBillRequest(bill, service_id, listener));
    }

    public void getProfile(Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new GetProfileRequest(listener));
    }

    public void getHistory(int service_id, String bill, Listener listener){
        ZkhApp.getInstanse().getRequestQueue().add(new GetHistoryRequest(service_id, bill, listener));
    }
}
