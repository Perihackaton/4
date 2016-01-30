package com.natateam.myzkh;

import com.android.volley.RequestQueue;

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
}
