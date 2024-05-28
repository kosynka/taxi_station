<?php

declare(strict_types=1);

namespace App\Traits;

trait Commentable
{
    public function addComment(array $changes): void
    {
        $comments = $this->comments ?? [];

        $id = count($comments) + 1;

        $new_comment = [
            $id => [
                'id' => $id,
                'text' => $changes['text'],
                'old_status' => $this->status,
                'new_status' => isset($changes['status']) ? $changes['status'] : $this->status,
                'user_id' => auth()->user()->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]
        ];

        $this->comments = $comments + $new_comment;
    }

    public function getLastComment(): array|bool
    {
        $comments = $this->comments ?? [];

        if (empty($comments)) {
            return false;
        }

        return end($comments);
    }
}
