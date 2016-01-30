package com.natateam.myzkh.net;

import com.natateam.myzkh.managers.SharedManager;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by macbook on 31/01/ 15.
 */
public class RegCodeRequest extends BaseRequest {
    public static final String API="register_by_code/";
    public RegCodeRequest(String login, String code, Listener listener) {
        super(Method.POST, API, listener);
        addParam("login", login);
        addParam("code",code);
    }

    @Override
    protected void parseResponse() throws JSONException {
        if (getDataString()!=null){
            String token=new JSONObject(getDataString()).getString("token");
            SharedManager.getInstase().setToken(token);
        }
        notifySuccess();
    }
}
