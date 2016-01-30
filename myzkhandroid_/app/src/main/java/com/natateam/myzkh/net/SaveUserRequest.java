package com.natateam.myzkh.net;

import android.text.TextUtils;

import org.json.JSONException;

/**
 * Created by macbook on 31/01/ 15.
 */
public class SaveUserRequest extends BaseRequest {
    public static final String API="save_profile/";
    public SaveUserRequest(String fio,String city, String street,
                           String house, String corpse, String flat, Listener listener) {
        super(Method.POST, API, listener);
        addParam("fio", fio);
        addParam("city",city);
        addParam("street",street);
        addParam("house",house);
        if (!TextUtils.isEmpty(corpse)){
            addParam("corpse",corpse);
        }
        if (!TextUtils.isEmpty(flat)){
            addParam("flat",flat);
        }
    }

    @Override
    protected void parseResponse() throws JSONException {
        notifySuccess();
    }
}
