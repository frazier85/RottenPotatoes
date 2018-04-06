package com.group4.rottenpotatoes;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

public class SongAdapter extends RecyclerView.Adapter<SongAdapter.SongViewHolder> {

    private Context mCtx;
    private List<Song> songList;

    public SongAdapter(Context mCtx, List<Song> productList) {
        this.mCtx = mCtx;
        this.songList = productList;
    }

    @Override
    public SongViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(mCtx);
        View view = inflater.inflate(R.layout.song_list, null);
        return new SongViewHolder(view);
    }

        @Override
    public void onBindViewHolder(SongViewHolder holder, int position) {

        Song song = songList.get(position);

        holder.textViewTitle.setText(song.getTitle());
        holder.textViewArtist.setText(song.getArtist());
        holder.textViewAlbum.setText(song.getAlbum());
        holder.textViewReview.setText(song.getReview());
    }

    @Override
    public int getItemCount() {
        return songList.size();
    }

    class SongViewHolder extends RecyclerView.ViewHolder
    {

        TextView textViewTitle, textViewArtist, textViewAlbum, textViewReview;

        public SongViewHolder(View itemView) {
            super(itemView);

            textViewTitle = itemView.findViewById(R.id.textViewTitle);
            textViewArtist = itemView.findViewById(R.id.textViewArtist);
            textViewAlbum = itemView.findViewById(R.id.textViewAlbum);
            textViewReview = itemView.findViewById(R.id.textViewReview);
        }
    }

}
