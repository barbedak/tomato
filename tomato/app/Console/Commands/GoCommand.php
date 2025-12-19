<?php

namespace App\Console\Commands;

use App\Events\User\StoredUserEvent;
use App\Mail\Comment\StoreCommentMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\File;
use App\Models\Group;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Log;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run command go';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $post = Post::first(); // буд post_id=1
        //attach([1,2,3]) добавление новых данных, генерит копии
        //$post->tags()->attach([1,2,3]);
        //detach() удаляет
        //$post->tags()->sync([1,2]) добавляет только переданные данные, остальные удаляет
        //syncWithoutDetaching([1,2,3]) добавляет данные, не удаляя
        //toggle если связь есть, то удалит, если нет - создает
//        $post->tags()->toggle([1]);
//        $post->tags()->updateExistingPivot(id, ['name' => 'value']);
//        $post->tags()->syncWithoutDetaching([1,2,3]);
//        $post->tags()->toggle([1]);
//        $post->tags()->sync([1,2,4,9]);
//        $post->tags()->detach([4]);

//        User -> Profile -> Posts
//        $user = User::first();
//        dd($user->posts);

//        Post -> Profile -> User
//        $post = Post::first();
//        dd($post->user);

//        User -> Profile -> Comments
//        $user = User::first();
//        dd($user->comments);

//        Comment -> Profile -> User
//        $comment = Comment::first();
//        dd($comment->user);

//        User -> Profile -> Groups
//        $user = User::find(3);
//        dd($user->groups);

//        Group -> Profile -> User
//        $group = Group::first();
//        dd($group->user);

//        Profile -> Groups -> Themes
//        $profile = Profile::find(2);
//        dd($profile->themes);

//        Theme -> Group -> Profile
//        $theme = Theme::first();
//        dd($theme->profile);

//        Soft delete
//        $category = Category::find(1);
//        $category->delete();
        // $category->forceDelete() //для полного удаления
//        $category = Category::withTrashed()->find(1); поиск и в корзине
//        $category->restore();

//        polymorphs
//        $profile = Profile::first();
//        $post = Post::first();
//        $post->image()->create([
//            'path' => 'tomato.jpg'
//        ]);
//        $image = Image::first();
//        dd($image->imageable);
//        $post->comments()->create([
//            'body' => 'text body',
//            'profile_id' => 1
//        ]);
//        dd($post->comments);
//        $comment = Comment::first();
//        dd($comment->commentable);
//        $post->likes()->attach(1);
//        dd($profile->likedPosts);
//        homework
//        $post->views()->attach(1);
//        dd($profile->viewedPosts());
//        $post->file()->create([
//            'title' => 'first file title'
//        ]);
//        $post->file()->create([
//            'title' => 'second file title'
//        ]);
//        $post->file()->create([
//            'title' => 'third file title'
//        ]);
//        dd($post->file);
//        dd($post->files);
//        $file = File::first();
//        dd($file->fileable);
//        $user = User::factory()->create();
//        StoredUserEvent::dispatch($user);
//        $post = Post::first();

//        $profile = Profile::first();
//        $profile->update(['name' => 'Vasya']);
//        $profile->delete();
//        $post->update(['title' => 'title']);
//        $profile = Profile::first();
        //логирование
//        $post = Post::factory()->create();
//        Log::channel('posts')->info('post created {id}', ['id' => $post->id]);
//        $post = Post::first();
//        $post->delete();
//        $post = Post::first();
//        $post->permission()->create([
//            'role_id' => 1,
//            'operation' => 'index'
//        ]);
//        $role = Role::first();
//        $role->permissions()->create([
//            'table'=>'posts',
//            'operation'=>'index',
//        ]);
//        $role->permissions()->create([
//            'table'=>'videos',
//            'operation'=>'index',
//        ]);
//        $profile = Profile::first();
//        dump($profile->user->name);
//        отправка почты
//        $user = User::first();
//        Mail::to($user)->send(new StoreCommentMail());

        //notification
        $post = Post::first();
        $comment = $post->comments()->create([
            'body' => 'trew',
            'profile_id' => 1
        ]);
        $comment->notifications()->create([
            'body' => 'comment in your post',
            'profile_id' => 1
        ]);

    }
}
