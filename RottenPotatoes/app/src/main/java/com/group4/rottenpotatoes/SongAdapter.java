package com.group4.rottenpotatoes;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import java.io.InputStream;
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

        // Get the album art, if available
        if(!song.getLink().isEmpty())
        {
            new DownloadImageTask(holder.imageView).execute(song.getLink());
        }
    }

    @Override
    public int getItemCount() {
        return songList.size();
    }

    class SongViewHolder extends RecyclerView.ViewHolder
    {

        TextView textViewTitle, textViewArtist, textViewAlbum, textViewReview;
        ImageView imageView;

        public SongViewHolder(View itemView) {
            super(itemView);

            imageView = itemView.findViewById(R.id.imageView);
            textViewTitle = itemView.findViewById(R.id.textViewTitle);
            textViewArtist = itemView.findViewById(R.id.textViewArtist);
            textViewAlbum = itemView.findViewById(R.id.textViewAlbum);
            textViewReview = itemView.findViewById(R.id.textViewReview);
        }
    }

    private static class DownloadImageTask extends AsyncTask<String, Void, Bitmap> {
        ImageView bmImage;

        public DownloadImageTask(ImageView bmImage) {
            this.bmImage = bmImage;
        }

        protected Bitmap doInBackground(String... urls) {
            String urldisplay = urls[0];
            Bitmap mIcon11 = null;
            try {
                InputStream in = new java.net.URL(urldisplay).openStream();
                mIcon11 = BitmapFactory.decodeStream(in);
            } catch (Exception e) {
                Log.e("Error", e.getMessage());
                e.printStackTrace();
            }
            return mIcon11;
        }

        protected void onPostExecute(Bitmap result) {
            bmImage.setImageBitmap(result);
        }
    }
}
