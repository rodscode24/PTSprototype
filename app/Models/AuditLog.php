<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'user_email',
        'category',
        'action',
        'subject_type',
        'subject_id',
        'subject_name',
        'changes',
    ];

    protected function casts(): array
    {
        return [
            'changes' => 'array',
        ];
    }

    public static function record(string $category, string $action, Model $subject, array $before = [], array $after = []): self
    {
        $user = auth()->user();

        return self::create([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'category' => $category,
            'action' => $action,
            'subject_type' => $subject::class,
            'subject_id' => $subject->getKey(),
            'subject_name' => $subject->name ?? $subject->title ?? $subject->hero_title ?? $subject->identifier ?? null,
            'changes' => self::diff($before, $after),
        ]);
    }

    private static function diff(array $before, array $after): array
    {
        $diff = [];

        foreach ($after as $key => $value) {
            if (($before[$key] ?? null) !== $value) {
                $diff[$key] = [
                    'before' => $before[$key] ?? null,
                    'after' => $value,
                ];
            }
        }

        return $diff;
    }
}
