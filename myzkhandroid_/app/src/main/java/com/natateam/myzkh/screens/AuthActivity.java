package com.natateam.myzkh.screens;

import android.app.ActionBar;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.R;
import com.natateam.myzkh.model.ActivityMediator;

/**
 * Created by macbook on 29/01/ 15.
 */
public class AuthActivity extends BaseActivity {
    ActivityMediator activityMediator;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_auth);
        activityMediator= new ActivityMediator(this);
    }

    public void showMain(){
        finish();
        activityMediator.showMain();
    }
}
