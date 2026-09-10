<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'credentials',
        'bio',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function imageUrl(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        return asset('storage/'.$this->image_path);
    }

    public static function seedDefaults(): void
    {
        foreach (self::defaults() as $index => $member) {
            self::query()->firstOrCreate(
                ['name' => $member['name']],
                [...$member, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    public static function defaults(): array
    {
        return [
            [
                'name' => 'Ruggie',
                'credentials' => 'PT, MS, CMPT, MBA',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_f0af109baa584b5aa32f6c9c04cb0687~mv2.png/v1/crop/x_0,y_210,w_2066,h_2066/fill/w_440,h_440,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Ruggie_New_edited.png',
                'bio' => 'Ruggie completed his bachelors in physical therapy in 1985 and graduated Magna Cum Laude from the University of Santo Tomas (UST), Manila, Philippines.',
            ],
            [
                'name' => 'Joe',
                'credentials' => 'PT, DPT, OMT, CPI, CLT',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_186d85c9b0c54eac901573a27c3aa52e~mv2.jpg/v1/crop/x_19,y_0,w_320,h_320/fill/w_440,h_440,al_c,lg_1,q_80,enc_avif,quality_auto/Joe-Brazill-Physical-Therapy-Services-Eu.jpg',
                'bio' => 'Joe values a varied experience with the goal of meeting the needs of the community. He graduated with his Doctor of Physical Therapy from the University of Washington in 2009, completed orthopedic manual therapy residency, became a Certified STOTT Pilates Instructor, and became a certified lymphedema therapist in 2021.',
            ],
            [
                'name' => 'Brittany',
                'credentials' => 'PT Assistant',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_0779d56fb2224303988eb780712d1e03~mv2.jpeg/v1/crop/x_0,y_0,w_735,h_735/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Brittany%20selfie.jpeg',
                'bio' => 'I was born and raised in Eugene and graduated from Lane Community College as a PTA in 2019. My passion is working with the oncology population as well as general orthopedic conditions.',
            ],
            [
                'name' => 'Kelsi',
                'credentials' => 'PT Assistant, CLT, LMT',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_acad41b4af0a4cf4bd00f86268493472~mv2.jpg/v1/crop/x_0,y_0,w_2296,h_2296/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Kelsi%27s%20New%20Photo_JPG.jpg',
                'bio' => 'Kelsi graduated from Lane Community College in 2021 with her Associates in Physical Therapy Assistant. She has a unique ability to incorporate manual soft tissue manipulation techniques and exercises for Oncology and Orthopedics. License Number: 16665.',
            ],
            [
                'name' => 'Jared',
                'credentials' => 'PT Assistant',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_fc9071adc00a4070939ee2383398b2c9~mv2.jpg/v1/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Jared_edited.jpg',
                'bio' => 'Jared was born and raised in Springfield, graduated from the University of Oregon with a Bachelors in Human Physiology, and graduated from Lane Community College PT Assistant program in 2014. Outside of the clinic he loves spending time with family.',
            ],
            [
                'name' => 'Danielle',
                'credentials' => 'LMT',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_1aae874b9d89454aa2c6905e69b5e3ed~mv2.jpg/v1/crop/x_0,y_0,w_2304,h_2304/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Danielle%20Beaty_JPG.jpg',
                'bio' => 'Danielle grew up in the Veneta/Elmira area and now lives in Eugene. She has been an LMT since 2017 and loves the clinical atmosphere. She enjoys weightlifting, hiking, kayaking, and time outdoors.',
            ],
            [
                'name' => 'Joyce',
                'credentials' => 'Administrative Support',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_a13cf7e11d20478082af80149c25cbea~mv2.jpg/v1/fill/w_440,h_440,al_c,lg_1,q_80,enc_avif,quality_auto/Joyce-Canizares-Owner-Office-Manager-Physical-Therapy-Services-Eugene-Oregon_edited.jpg',
                'bio' => 'Joyce graduated from Linfield College with a bachelor’s in Business Information Systems and performs support staff duties at the clinic. She loves spending time with family, gardening, walking, hiking, and cooking.',
            ],
            [
                'name' => 'Cameron',
                'credentials' => 'Front Office Specialist',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_b319c903ce1d478facac54a408f832ce~mv2.jpg/v1/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Cameron_edited.jpg',
                'bio' => 'Born in California and growing up in Utah, Cameron is making his home in Oregon. With an associates in Social and Behavioral Sciences, he has an eye to the medical field and helping others.',
            ],
            [
                'name' => 'Jada',
                'credentials' => 'Front Office Specialist',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_a32fdbf008bd438d9f532f9ff9fd392f~mv2.jpg/v1/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Jada_edited_edited.jpg',
                'bio' => 'Originally from Sonoma County, CA, Jada brings energy to the PTS clinic. With a background in customer service and data entry, she welcomes patients with bright eyes and a cheery tone.',
            ],
            [
                'name' => 'Mike',
                'credentials' => 'Front Office Specialist',
                'image_path' => 'https://static.wixstatic.com/media/2f1ef4_fe77f59a9f894df9a846faaf60370166~mv2.jpg/v1/fill/w_440,h_440,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Mike_edited.jpg',
                'bio' => 'Originally from Seattle, Mike found his home in Eugene. He is passionate about the community and enjoys kayaking, animals, food, and baseball.',
            ],
        ];
    }
}
