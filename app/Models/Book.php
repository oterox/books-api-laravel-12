<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'published_year',
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_year' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Get the validation rules for the model.
     *
     * @return array<string, string>
     */
    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'nullable|string|max:13|unique:books,isbn',
            'published_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'price' => 'nullable|numeric|min:0|max:999999.99',
        ];
    }
}
