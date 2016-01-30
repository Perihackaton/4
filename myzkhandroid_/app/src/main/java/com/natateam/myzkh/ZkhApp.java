package com.natateam.myzkh;

import android.app.Application;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/**
 * Created by macbook on 29/01/ 15.
 */
public class ZkhApp extends Application {
    private  volatile static ZkhApp _singletone;
    private Toast toast;
    private RequestQueue mRequestQueue;
    public static ZkhApp getInstanse(){
        if (_singletone==null){
            _singletone= new ZkhApp();
            _singletone.onCreate();
        }
        return _singletone;
    }

    @Override
    public void onCreate() {
        super.onCreate();
        _singletone=this;
    }

    public void showToast(String message) {
        if (toast != null) {
            toast.cancel();
        }
        int duration = Toast.LENGTH_LONG;
        toast = Toast.makeText(this, message, duration);
        toast.show();
    }

    public RequestQueue getRequestQueue() {
        if (mRequestQueue == null) {
            mRequestQueue = Volley.newRequestQueue(this);
        }
        return mRequestQueue;
    }
}
