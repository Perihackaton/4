package com.natateam.myzkh.screens;

import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.R;
import com.natateam.myzkh.fragments.MainFragment;
import com.natateam.myzkh.fragments.SettFragment;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.model.ActivityMediator;

public class MainActivity extends BaseActivity {
    private SharedManager sharedManager;
    public ActivityMediator activityMediator;
    NavigationView navigationView;
    DrawerLayout drawerLayout;
    Toolbar toolbar;
    TextView txtTitle;
    LinearLayout mToolbarLayout;
    ImageView imgMenu;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        sharedManager=SharedManager.getInstase();
        activityMediator= new ActivityMediator(this);
        toolbar = (Toolbar) findViewById(R.id.tool_bar);
        mToolbarLayout = (LinearLayout) toolbar.findViewById(R.id.toolbar_view);
        txtTitle=(TextView)mToolbarLayout.findViewById(R.id.txtTitle);
        /*TextView toolbarTitle=(TextView)mToolbarLayout.findViewById(R.id.txtTitle);
        toolbarTitle.setTypeface(CurierApp.getInstanse().getSegoeScript());
        toolbar.addView(mToolbarLayout);*/
        imgMenu=(ImageView)mToolbarLayout.findViewById(R.id.imgMenu);
        navigationView=(NavigationView)findViewById(R.id.navigation_view);
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(MenuItem menuItem) {
                if (!menuItem.isChecked()) {
                    menuItem.setChecked(true);
                    switch (menuItem.getItemId()) {
                        case R.id.drawer_main:
                            setFragmentByTag(MainFragment.TAG, R.id.frag_content, false);
                            break;
                        case R.id.drawer_sett:
                            setFragmentByTag(SettFragment.TAG, R.id.frag_content, false);
                            break;

                    }
                }
                drawerLayout.closeDrawers();
                return true;
            }
        });
        final TextView txtName=(TextView)navigationView.getHeaderView(0).findViewById(R.id.txtName);
        drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawerLayout.setDrawerListener(new DrawerLayout.DrawerListener() {
            @Override
            public void onDrawerSlide(View drawerView, float slideOffset) {

            }

            @Override
            public void onDrawerOpened(View drawerView) {
                txtName.setText(SharedManager.getInstase().getProfile().fio);
            }

            @Override
            public void onDrawerClosed(View drawerView) {

            }

            @Override
            public void onDrawerStateChanged(int newState) {

            }
        });

        imgMenu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                drawerLayout.openDrawer(GravityCompat.START);
            }
        });
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayShowTitleEnabled(false);
        Button buttonScan=(Button)findViewById(R.id.btnScan);
        buttonScan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                activityMediator.showScan();
            }
        });
    }


    @Override
    public void setTitleByTag(String tag) {
        super.setTitleByTag(tag);
        toolbar = (Toolbar) findViewById(R.id.tool_bar);
        mToolbarLayout = (LinearLayout) toolbar.findViewById(R.id.toolbar_view);
        txtTitle=(TextView)mToolbarLayout.findViewById(R.id.txtTitle);
        if (tag.equals(MainFragment.TAG)){
            txtTitle.setText(getString(R.string.main_title));
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        if (sharedManager.getProfile().token==null){
            finish();
            activityMediator.showAuth();
        }
    }
}
