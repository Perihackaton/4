package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.natateam.myzkh.R;

/**
 * Created by macbook on 30/01/ 15.
 */
public class SettFragment extends BaseFragment {
    public static final String TAG="com.natateam.myzkh.fragments.SettFragment";
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_settings,null);
    }
}
