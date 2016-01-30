package com.natateam.myzkh.net;

import com.natateam.myzkh.fragments.BaseFragment;
import com.natateam.myzkh.managers.SharedManager;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by macbook on 30/01/ 15.
 */
public class AuthRequest extends BaseRequest {
    public static final String API="auth/";
    public AuthRequest(String login, String pass, Listener listener) {
        super(Method.POST, API, listener);
        addParam("login", login);
        addParam("password",pass);

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
