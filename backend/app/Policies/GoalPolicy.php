<?php

namespace App\Policies;

use App\Goal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the goal.
     *
     * @param  \App\User  $user
     * @param  \App\Goal  $goal
     * @return mixed
     */
    public function view(?User $user, Goal $goal)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create goals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the goal.
     *
     * @param  \App\User  $user
     * @param  \App\Goal  $goal
     * @return mixed
     */
    public function update(User $user, Goal $goal)
    {
        //
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can delete the goal.
     *
     * @param  \App\User  $user
     * @param  \App\Goal  $goal
     * @return mixed
     */
    public function delete(User $user, Goal $goal)
    {
        //
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can restore the goal.
     *
     * @param  \App\User  $user
     * @param  \App\Goal  $goal
     * @return mixed
     */
    public function restore(User $user, Goal $goal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the goal.
     *
     * @param  \App\User  $user
     * @param  \App\Goal  $goal
     * @return mixed
     */
    public function forceDelete(User $user, Goal $goal)
    {
        //
    }
}
