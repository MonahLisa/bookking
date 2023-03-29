<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property int $price
 * @property string $image
 * @property string $document
 *
 * @property BookHasAuthor[] $bookHasAuthors
 * @property BookHasGenre[] $bookHasGenres
 * @property BookHasPublishing[] $bookHasPublishings
 * @property SeriesHasBook[] $seriesHasBooks
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'price', 'image', 'document'], 'required'],
            [['date'], 'safe'],
            [['price'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            ['document', 'file', 'extensions'=>['doc', 'docx', 'pdf'], 'maxSize'=>10485760],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date' => 'Date',
            'price' => 'Price',
            'image' => 'Image',
            'document' => 'Document',
        ];
    }

    /**
     * Gets query for [[BookHasAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasAuthors()
    {
        return $this->hasMany(BookHasAuthor::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookHasGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasGenres()
    {
        return $this->hasMany(BookHasGenre::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookHasPublishings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasPublishings()
    {
        return $this->hasMany(BookHasPublishing::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[SeriesHasBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeriesHasBooks()
    {
        return $this->hasMany(SeriesHasBook::class, ['book_id' => 'id']);
    }
}
