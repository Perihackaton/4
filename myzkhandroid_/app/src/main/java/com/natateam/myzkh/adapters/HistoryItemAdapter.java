package com.natateam.myzkh.adapters;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.natateam.myzkh.AppUtils;
import com.natateam.myzkh.R;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillHistoryItem;
import com.natateam.myzkh.dbmodel.BillService;
import com.natateam.myzkh.managers.DbManager;

import io.realm.RealmResults;

/**
 * Created by macbook on 30/01/ 15.
 */
public class HistoryItemAdapter extends RecyclerView.Adapter<HistoryItemAdapter.ViewHolder> {
    private RealmResults<BillHistoryItem> mDataset;
    private View.OnClickListener listener;



    // Provide a reference to the views for each data item
// Complex data items may need more than one view per item, and
// you provide access to all the views for a data item in a view holder
    public static class ViewHolder extends RecyclerView.ViewHolder {
        // each data item is just a string in this case
        public View mainView;
        public TextView txtDate,txtDeptEnd,txtDeptBegin,txtEnrolled,txtPaied;

        public ViewHolder(View v) {
            super(v);
            mainView = v;
            txtDate=(TextView)v.findViewById(R.id.txtDate);
            txtDeptBegin=(TextView)v.findViewById(R.id.txtDeptBegin);
            txtDeptEnd=(TextView)v.findViewById(R.id.txtDeptEnd);
            txtEnrolled=(TextView)v.findViewById(R.id.txtEnrolled);
            txtPaied=(TextView)v.findViewById(R.id.txtPaied);
        }
    }

    // Provide a suitable constructor (depends on the kind of dataset)
    public HistoryItemAdapter(RealmResults<BillHistoryItem> items,View.OnClickListener listener) {
        mDataset = items;
        this.listener=listener;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public HistoryItemAdapter.ViewHolder onCreateViewHolder(ViewGroup parent,
                                                            int viewType) {
        // create a new view
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.history_item, parent, false);
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
        final BillHistoryItem item = mDataset.get(position);
        holder.txtDate.setText(item.getDate());
        int color= AppUtils.getColorForDept(item.getDept_end());
        String rouble=" р.";
        holder.txtDeptEnd.setTextColor(color);
        color=AppUtils.getColorForDept(item.getDept_begin());
        holder.txtDeptBegin.setTextColor(color);
        holder.txtPaied.setText(Double.toString(item.getPaid())+rouble);
        holder.txtEnrolled.setText(Double.toString(item.getEnrolled())+rouble);
        holder.txtDeptEnd.setText(Double.toString(item.getDept_end())+rouble);
        holder.txtDeptBegin.setText(Double.toString(item.getDept_begin())+rouble);

    }


    // Return the size of your dataset (invoked by the layout manager)
    @Override
    public int getItemCount() {
        return mDataset.size();
    }

    public void setmDataset(RealmResults<BillHistoryItem> mDataset) {
        this.mDataset = mDataset;
        notifyDataSetChanged();
    }
}

