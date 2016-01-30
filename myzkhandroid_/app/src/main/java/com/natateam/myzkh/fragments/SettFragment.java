package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.CardView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.R;
import com.natateam.myzkh.managers.SharedManager;

/**
 * Created by macbook on 30/01/ 15.
 */
public class SettFragment extends BaseFragment {
    public static final String TAG="com.natateam.myzkh.fragments.SettFragment";
    CardView cardProfile;
    CardView cardAdd;
    BaseActivity activity;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_settings,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(BaseActivity)getActivity();
        cardProfile=(CardView)getView().findViewById(R.id.cardProfile);
        cardAdd=(CardView)getView().findViewById(R.id.cardAddBill);
        cardProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedManager.getInstase().setIsNeedAddBill(false);
                activity.setFragmentByTag(ProfileFragment.TAG,R.id.frag_content,false);
            }
        });
        cardAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                boolean isFull= SharedManager.getInstase().isProfileFull();
                if (isFull){
                    activity.setFragmentByTag(ServicesFragment.TAG, R.id.frag_content, false);
                }else {
                    SharedManager.getInstase().setIsNeedAddBill(true);
                    activity.setFragmentByTag(ProfileFragment.TAG,R.id.frag_content,false);
                }
            }
        });
    }
}
