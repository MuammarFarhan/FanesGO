<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // [cite: 1914]
use Illuminate\Support\Facades\Storage; // [cite: 1915]

class File extends Model
{
    use HasUuids; // [cite: 1918]

    protected $fillable = ['alias', 'filename', 'path', 'mime_type', 'size']; // [cite: 1919] (mime_type diperbaiki)

    public function fileable()
    {
        return $this->morphTo(); // [cite: 1920-1923]
    }

    public function getFileStreamAttribute()
    {
        // [cite: 1925-1928]
        return route('files.action', ['id' => $this->id, 'action' => 'stream']);
    }

    public function getFileDownloadAttribute()
    {
        // [cite: 1930-1933]
        return route('files.action', ['id' => $this->id, 'action' => 'download']);
    }

    public function handleAction($action)
    {
        // [cite: 1935-1949]
        if (!Storage::exists($this->path)) {
            abort(404, 'File tidak ditemukan');
        }

        if ($action === 'stream') {
            return response()->file(Storage::path($this->path), [
                'Content-Type' => $this->mime_type,
            ]);
        }

        if ($action === 'download') {
            return Storage::download($this->path, $this->filename);
        }

        abort(400, 'Aksi tidak valid');
    }
}