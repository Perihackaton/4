package com.natateam.myzkh;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.ActionBarActivity;

import com.natateam.myzkh.fragments.BaseFragment;
import com.natateam.myzkh.fragments.BillFragment;
import com.natateam.myzkh.fragments.MainFragment;
import com.natateam.myzkh.fragments.NewsFragment;
import com.natateam.myzkh.fragments.OrderFragment;
import com.natateam.myzkh.fragments.ProfileFragment;
import com.natateam.myzkh.fragments.ServicesFragment;
import com.natateam.myzkh.fragments.SettFragment;
import com.natateam.myzkh.screens.AuthActivity;

/**
 * Created by macbook on 29/01/ 15.
 */
public class BaseActivity extends ActionBarActivity {

    protected String mPrevVisibleFragment, mCurrentVisibleFragment;
    boolean mWasBackPressed;
    private ProgressDialog progressDialog;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        progressDialog= new ProgressDialog(this);
        progressDialog.setMessage(getString(R.string.progress_dialog_text));
        progressDialog.setCancelable(false);
        final FragmentManager fm = getSupportFragmentManager();
        fm.addOnBackStackChangedListener(new FragmentManager.OnBackStackChangedListener() {
            @Override
            public void onBackStackChanged() {
                final int count = fm.getBackStackEntryCount();
                if (count == 0 && mWasBackPressed) {
                    finish();
                    return;
                } else {
                    if (count > 0) {
                        mCurrentVisibleFragment = fm.getBackStackEntryAt(count - 1).getName();
                        setFragmentByTag(mCurrentVisibleFragment, R.id.frag_content, true);
                    }
                }
            }
        });

        addFirstFragment(savedInstanceState);
    }

    public void setFragmentByTag(String tag, int content_id, boolean addToStack) {
        setFragmentByTag(tag, content_id, null, addToStack);
    }
    private void addFirstFragment(final Bundle savedState)
    {
        if (savedState == null)
        {
            if (this instanceof AuthActivity) {
                setFragmentByTag(AuthFragment.class.getName(), R.id.frag_content,true );
            }else {
                setFragmentByTag(MainFragment.class.getName(), R.id.frag_content, false);
            }
        }
        else
        {
            final FragmentManager fm = getSupportFragmentManager();
            if (fm != null && fm.getBackStackEntryCount() > 0)
            {
                final FragmentManager.BackStackEntry e = fm.getBackStackEntryAt(fm.getBackStackEntryCount() - 1);
                setFragmentByTag(e.getName(), R.id.frag_content, true);
                return;
            }
            if (this instanceof AuthActivity) {
                setFragmentByTag(AuthFragment.class.getName(), R.id.frag_content, true);
            }else {
                setFragmentByTag(MainFragment.class.getName(), R.id.frag_content, false);
            }
        }
    }

    public void setFragmentByTag(String name, int content_id, Bundle params, boolean addToStack) {
        if (mCurrentVisibleFragment == null || !mCurrentVisibleFragment.equals(name))
        {
            if (mCurrentVisibleFragment != null)
                mPrevVisibleFragment = new String(mCurrentVisibleFragment);
            mCurrentVisibleFragment = name;
        }
        final FragmentManager fm = getSupportFragmentManager();
        Fragment fragment;
        if (fm != null) {
            if (mPrevVisibleFragment != null && mPrevVisibleFragment.equals(name) && !mPrevVisibleFragment.equals(mCurrentVisibleFragment)) {
                return;
            }

            final FragmentTransaction ft = fm.beginTransaction();
            ft.setCustomAnimations(R.anim.fade_in, R.anim.fade_out);
            fragment = fm.findFragmentByTag(mPrevVisibleFragment);

            if (fragment != null)
                ft.hide(fragment);

            fragment = fm.findFragmentByTag(name);
            if (fragment == null) {
                fragment = instantinateFragment(name, params);
                if (fragment == null)
                    return;
                ft.add(content_id, fragment, name);

                ft.show(fragment);
                if (addToStack) // fm.getFragments() != null &&
                    ft.addToBackStack(name);
                ft.commitAllowingStateLoss();
            } else {
                ft.show(fragment);
                ft.commitAllowingStateLoss();
            }
        }
        setTitleByTag(name);

    }


    private Fragment instantinateFragment(final String name, final Bundle params) {
        Class cl = null;

        try {
            cl = Class.forName(name);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            return null;
        }

        Fragment fr = null;
        fr = BaseFragment.getInstance(cl, params);
        return fr;
    }

    @Override
    public void onBackPressed() {
        mWasBackPressed=true;
        boolean isNeedFinish=false;
        if (this instanceof AuthActivity){
            super.onBackPressed();
        }else {
            if (mCurrentVisibleFragment.equals(MainFragment.TAG) ||
                    mCurrentVisibleFragment.equals(SettFragment.TAG)||
                    mCurrentVisibleFragment.equals(NewsFragment.TAG)||
                    mCurrentVisibleFragment.equals(OrderFragment.TAG)) {
                isNeedFinish = true;
            }
            if (isNeedFinish) {
                super.onBackPressed();
                return;
            }

            if (mPrevVisibleFragment != null && mPrevVisibleFragment.equals(BillFragment.TAG)) {
                mPrevVisibleFragment = MainFragment.TAG;
            }
            if (mPrevVisibleFragment != null) {
                setFragmentByTag(mPrevVisibleFragment, R.id.frag_content, false);
            }
        }
    }

    public void setTitleByTag(String tag){

    }

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);
        final FragmentManager fm = getSupportFragmentManager();
        if (fm != null)
        {
            final int count = fm.getBackStackEntryCount();
            if (count > 0)
            {
                mCurrentVisibleFragment = fm.getBackStackEntryAt(count - 1).getName();
                if (fm.getBackStackEntryCount() > 1)
                    mPrevVisibleFragment = fm.getBackStackEntryAt(count - 2).getName();
                else
                    mPrevVisibleFragment = mCurrentVisibleFragment;
            }
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
    }

    public void showProgress(String message){
        if (progressDialog!=null) {
            progressDialog.setMessage(message);
            progressDialog.show();
        }
    }
    public void showProgress(){
        if (progressDialog!=null){
            progressDialog.setMessage(getString(R.string.progress_dialog_text));
            if (!progressDialog.isShowing()) {
                progressDialog.show();
            }
        }
    }

    public void hideProgress(){
        try {
            if (progressDialog != null) {
                progressDialog.dismiss();
                //progressDialog.hide();
            }
        }catch (Exception e){
            e.printStackTrace();
        }
    }
}
