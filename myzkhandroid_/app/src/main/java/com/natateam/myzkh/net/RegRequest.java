package com.natateam.myzkh.net;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by macbook on 31/01/ 15.
 */
public class RegRequest extends BaseRequest {
    public static final String API="register/";
    private String code;
    public RegRequest(String login, String pass,String fio, Listener listener) {
        super(Method.POST,API, listener);
        addParam("login", login);
        addParam("password",pass);
        addParam("fio",fio);
    }

    @Override
    protected void parseResponse() throws JSONException {
        if (getDataString()!=null){
            code=new JSONObject(getDataString()).getString("activation_key");
        }
        notifySuccess();
    }

    public String getCode() {
        return code;
    }
}
