package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.text.TextUtils;
import android.text.method.QwertyKeyListener;
import android.text.method.TextKeyListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.model.Profile;

/**
 * Created by macbook on 30/01/ 15.
 */
public class ProfileFragment extends BaseFragment {
    public static final String TAG="com.natateam.myzkh.fragments.ProfileFragment";
    EditText editFio,editCity,editStreet,editHouse,editCorpse,editFlat;
    Button btnSave;
    BaseActivity activity;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_profile,null);

    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(BaseActivity)getActivity();
        QwertyKeyListener qkl=new QwertyKeyListener(TextKeyListener.Capitalize.WORDS,true);
        Profile profile= SharedManager.getInstase().getProfile();
        editFio=(EditText)getView().findViewById(R.id.editFio);
        editFio.setKeyListener(qkl);
        editStreet=(EditText)getView().findViewById(R.id.editStreet);
        editCity=(EditText)getView().findViewById(R.id.editCity);
        editCorpse=(EditText)getView().findViewById(R.id.editCorpse);
        editFlat=(EditText)getView().findViewById(R.id.editFlat);
        editHouse=(EditText)getView().findViewById(R.id.editHouse);
        btnSave=(Button)getView().findViewById(R.id.btnSave);
        editFio.setText(profile.fio);
        editCity.setText(profile.city);
        editCorpse.setText(profile.corpse);
        editFlat.setText(profile.flat);
        editStreet.setText(profile.street);
        editHouse.setText(profile.house);
        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedManager sharedManager=SharedManager.getInstase();
                boolean isNeed=sharedManager.isNeedAddBill();
                String name=editFio.getText().toString();
                String city=editCity.getText().toString();
                String street=editStreet.getText().toString();
                String flat=editFlat.getText().toString();
                String corpse=editCorpse.getText().toString();
                String house=editHouse.getText().toString();
                if (TextUtils.isEmpty(name)){
                    ZkhApp.getInstanse().showToast(getString(R.string.enter_name));
                    return;
                }
                if (TextUtils.isEmpty(city)){
                    ZkhApp.getInstanse().showToast(getString(R.string.enter_city));
                    return;
                }
                if (TextUtils.isEmpty(street)){
                    ZkhApp.getInstanse().showToast(getString(R.string.enter_street));
                    return;
                }
                if (TextUtils.isEmpty(house)){
                    ZkhApp.getInstanse().showToast(getString(R.string.enter_house));
                    return;
                }
                sharedManager.setFio(name);
                sharedManager.setCity(city);
                sharedManager.setStreet(street);
                sharedManager.setHouse(house);
                sharedManager.setCorpse(corpse);
                sharedManager.setFlat(flat);
                if (isNeed) {
                    SharedManager.getInstase().setIsNeedAddBill(false);
                    activity.setFragmentByTag(ServicesFragment.TAG,R.id.frag_content,false);
                }else {
                    ZkhApp.getInstanse().showToast(getString(R.string.profile_save));
                }
            }
        });
    }
}
