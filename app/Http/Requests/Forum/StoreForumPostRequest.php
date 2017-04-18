<?php

namespace App\Http\Requests\Forum;

use App\Models\Forum\ForumTopic;
use Illuminate\Foundation\Http\FormRequest;

class StoreForumPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == "put") {
            $topic = ForumTopic::find($this->route('forum'));

            return $topic && $this->user()->id == $topic->user_id;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic' => 'required|max:255',
            'tags' => 'required',
            'details' => 'required',
        ];
    }
}
