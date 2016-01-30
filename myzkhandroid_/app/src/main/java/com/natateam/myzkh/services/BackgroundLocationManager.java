package com.natateam.myzkh.services;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;

public class BackgroundLocationManager {
    private static BackgroundLocationManager manager;
    private Context ctx;

    private BackgroundLocationManager(Context ctx){
        this.ctx = ctx;
    }

    public static BackgroundLocationManager getInstance(Context ctx){
        if(manager == null){
            manager = new BackgroundLocationManager(ctx);
        }
        return manager;
    }


    public void startService(){
        Intent svc=new Intent(ctx, BackgroundLocationService.class);
        Bundle mBundle = new Bundle();
        mBundle.putString(BackgroundLocationService.INTENT_COMMAND, BackgroundLocationService.INTENT_COMMAND_START);
        svc.putExtras(mBundle);
        ctx.startService(svc);
    }

    public void stopService(){
        Intent svc=new Intent(ctx, BackgroundLocationService.class);
        ctx.stopService(svc);
    }

}
