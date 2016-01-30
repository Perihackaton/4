package com.natateam.myzkh;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

import com.natateam.myzkh.fragments.BaseFragment;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.model.NumberChangeListener;
import com.natateam.myzkh.net.*;
import com.natateam.myzkh.screens.AuthActivity;

/**
 * Created by macbook on 29/01/ 15.
 */
public class AuthFragment extends BaseFragment {

    public static final String TAG="com.natateam.myzkh.AuthFragment";
    Button btnReg,btnAuth;
    AuthActivity activity;
    EditText editPhone,editPass;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_auth,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(AuthActivity)getActivity();
        btnReg=(Button)getView().findViewById(R.id.btnReg);
        btnReg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                activity.setFragmentByTag(RegFragment.TAG,R.id.frag_content,true);
            }
        });
        editPhone=(EditText)getView().findViewById(R.id.editphone);
        editPhone.addTextChangedListener(new NumberChangeListener(editPhone));
        editPass=(EditText)getView().findViewById(R.id.editPass);
        btnAuth=(Button)getView().findViewById(R.id.btnEnter);
        btnAuth.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if (NetworkUtils.isNetworkAvailable(activity)){
                    String login=editPhone.getText().toString().replaceAll("[^\\d.]", "");
                    String pass=editPass.getText().toString();
                    activity.showProgress();
                    ApiFacade.getInstance().setAuth(login, pass, new Listener() {
                        @Override
                        public void onResponse(BaseRequest request) {
                            activity.hideProgress();
                            activity.showMain();
                        }

                        @Override
                        public void onError(com.natateam.myzkh.net.Error error, BaseRequest request) {
                            activity.hideProgress();
                        }
                    });
                }else {
                    ZkhApp.getInstanse().showToast(getString(R.string.check_internet_toast));
                }

            }
        });
    }
}
