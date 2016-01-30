package com.natateam.myzkh;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.text.method.QwertyKeyListener;
import android.text.method.TextKeyListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;

import com.natateam.myzkh.fragments.BaseFragment;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.model.NumberChangeListener;
import com.natateam.myzkh.screens.AuthActivity;

/**
 * Created by macbook on 29/01/ 15.
 */
public class RegFragment extends BaseFragment {
    public static final String TAG="com.natateam.myzkh.RegFragment";
    EditText editPhone,editFio,editPass,editRepeatPass,editCode;
    Button btnReg;
    AuthActivity activity;
    LinearLayout layoutCode;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_reg,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(AuthActivity)getActivity();
        QwertyKeyListener qkl=new QwertyKeyListener(TextKeyListener.Capitalize.WORDS,true);
        editPhone=(EditText)getView().findViewById(R.id.editphone);
        editPhone.addTextChangedListener(new NumberChangeListener(editPhone));
        editFio=(EditText)getView().findViewById(R.id.editfio);
        editFio.setKeyListener(qkl);
        editPass=(EditText)getView().findViewById(R.id.editPass);
        editRepeatPass=(EditText)getView().findViewById(R.id.editpassrepeat);
        btnReg=(Button)getView().findViewById(R.id.btnReg);
        editCode=(EditText)getView().findViewById(R.id.editcode);
        layoutCode=(LinearLayout)getView().findViewById(R.id.layoutCode);
        btnReg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (layoutCode.getVisibility()==View.GONE){
                    layoutCode.setVisibility(View.VISIBLE);
                    layoutCode.startAnimation(AnimationUtils.getFadeInAnimation());
                }else {
                    SharedManager.getInstase().setToken("token");
                    activity.showMain();
                }
            }
        });

    }
}
