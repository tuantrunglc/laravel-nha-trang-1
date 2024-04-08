<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Level;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
    public function updating(User $user)
{
    if ($user->isDirty('wallet')) { // Chỉ xử lý khi cột ví được thay đổi
        // Lấy cấp độ VIP phù hợp cao nhất dựa trên số dư ví hiện tại
        $level = Level::where('minimum_amount', '<=', $user->wallet)
                      ->orderByDesc('minimum_amount') // Sắp xếp giảm dần theo yêu cầu tiền tối thiểu
                      ->first();

        // Cập nhật cấp độ VIP, nếu không tìm thấy phù hợp thì gán là 0
        $user->level = $level ? $level->vip_level : 0;
    }
}
}
