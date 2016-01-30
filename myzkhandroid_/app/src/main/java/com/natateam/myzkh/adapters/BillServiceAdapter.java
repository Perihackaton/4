package com.natateam.myzkh.adapters;

import android.content.Intent;
import android.media.Image;
import android.support.v4.content.LocalBroadcastManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.natateam.myzkh.R;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillService;
import com.natateam.myzkh.managers.DbManager;

import java.util.ArrayList;

import io.realm.RealmResults;


/**
 * Created by macbook on 13/01/ 15.
 */
public class BillServiceAdapter extends RecyclerView.Adapter<BillServiceAdapter.ViewHolder> {
    private RealmResults <BillService> mDataset;
    private View.OnClickListener listener;


    // Provide a reference to the views for each data item
// Complex data items may need more than one view per item, and
// you provide access to all the views for a data item in a view holder
    public static class ViewHolder extends RecyclerView.ViewHolder {
        // each data item is just a string in this case
        public View mainView;
        public TextView txtName,txtDept,txtAllDept;
        public ImageView imgIcon;


        public ViewHolder(View v) {
            super(v);
            mainView = v;
            txtName=(TextView)v.findViewById(R.id.txtName);
            txtDept=(TextView)v.findViewById(R.id.txtDept);
            txtAllDept=(TextView)v.findViewById(R.id.txtAllDept);
            imgIcon=(ImageView)v.findViewById(R.id.imgLogo);
        }
    }

    // Provide a suitable constructor (depends on the kind of dataset)
    public BillServiceAdapter(RealmResults<BillService> items,View.OnClickListener listener) {
        mDataset = items;
        this.listener=listener;

    }

    // Create new views (invoked by the layout manager)
    @Override
    public BillServiceAdapter.ViewHolder onCreateViewHolder(ViewGroup parent,
                                                        int viewType) {
        // create a new view
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.bill_item, parent, false);
        // set the view's size, margins, paddings and layout parameters
        ViewHolder vh = new ViewHolder(v);
        return vh;
    }

    // Replace the contents of a view (invoked by the layout manager)
    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        // - get element from your dataset at this position
        // - replace the contents of the view with that element
        //holder.mTextView.setText(mDataset.get());
        final BillService item = mDataset.get(position);
        holder.txtName.setText(item.getName());
        Bill bill = DbManager.getInstanse().getBillByBillService(item.getService_id());
        holder.mainView.setOnClickListener(listener);
        switch (item.getService_id()){
            case BillService.BILL_1:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_1);
                break;
            }
            case BillService.BILL_2:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_2);
                break;
            }
            case BillService.BILL_3:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_3);
                break;
            }
            case BillService.BILL_4:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_4);
                break;
            }
            case BillService.BILL_5:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_5);
                break;
            }
            case BillService.BILL_6:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_6);
                break;
            }
            case BillService.BILL_7:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_7);
                break;
            }
            case BillService.BILL_8:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_8);
                break;
            }
            case BillService.BILL_9:{
                holder.imgIcon.setImageResource(R.drawable.icon_bill_9);
                break;
            }

        }
        if (bill!=null){
            holder.txtDept.setText(bill.getDept()+"р.");
        }else {
            holder.txtDept.setVisibility(View.GONE);
            holder.txtAllDept.setVisibility(View.GONE);
        }

    }


    // Return the size of your dataset (invoked by the layout manager)
    @Override
    public int getItemCount() {
        return mDataset.size();
    }

    public void setmDataset(RealmResults<BillService> mDataset) {
        this.mDataset = mDataset;
        notifyDataSetChanged();
    }
}
