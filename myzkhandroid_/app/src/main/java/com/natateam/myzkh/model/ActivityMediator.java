package com.natateam.myzkh.model;

import android.content.Context;
import android.content.Intent;

import com.natateam.myzkh.screens.AuthActivity;
import com.natateam.myzkh.screens.MainActivity;
import com.natateam.myzkh.screens.ScanActivity;


/**
 * Created by macbook on 27/01/15.
 */
public class ActivityMediator extends ContextMediator {
    /**
     * Конструктор
     *
     * @param context
     */
    public ActivityMediator(Context context) {
        super(context);
    }

    public void showMain(){
        /*ActivityOptionsCompat options =
                ActivityOptionsCompat.makeSceneTransitionAnimation(getContext(),
                        R.string.transition_name
                );*/
        Intent intent= new Intent(getContext(),MainActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        getContext().startActivity(intent);
    }

    public void showAuth(){
        /*ActivityOptionsCompat options =
                ActivityOptionsCompat.makeSceneTransitionAnimation(getContext(),
                        R.string.transition_name
                );*/
        Intent intent= new Intent(getContext(),AuthActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        getContext().startActivity(intent);
    }

    public void showScan(){
        Intent intent= new Intent(getContext(),ScanActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        getContext().startActivity(intent);
    }


}
