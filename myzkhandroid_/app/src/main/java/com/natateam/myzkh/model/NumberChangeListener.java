package com.natateam.myzkh.model;

import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;
import com.natateam.myzkh.AppUtils;


/**
 * Created by macbook on 22/06/ 15.
 */
public class NumberChangeListener implements TextWatcher  {
    private EditText editPhone;
    private boolean format;
    public NumberChangeListener(EditText editText){
        this.editPhone=editText;
    }


    @Override
    public void afterTextChanged(Editable s) {
        String formattedNumber = "";
        if (AppUtils.isEmpty(s))
            return;
        String formatS = s.toString().replaceAll("[^\\d.]", "");
        if (formatS.length() > 10) {
            formattedNumber = editPhone.getText().toString().substring(0, editPhone.getText().toString().length() - 1);
        } else {
            formattedNumber = AppUtils.FormatStringAsPhoneNumber(formatS);
        }
        if (formattedNumber != null) {
            if (!s.toString().equals(formattedNumber) && !format) {
                format = true;
                editPhone.setText(formattedNumber);
                if (formatS.length()<10) {
                    editPhone.setSelection(AppUtils.getSelectionForNumber(formatS.length()));
                }else {
                    editPhone.setSelection(editPhone.getText().length());
                }
                format = false;
            }
        }
    }

    @Override
    public void beforeTextChanged(CharSequence s, int start, int count, int after) {
    }

    @Override
    public void onTextChanged(CharSequence s, int start, int before, int count) {
    }
}


