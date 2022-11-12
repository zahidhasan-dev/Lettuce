<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class ContactEmailRule implements Rule
{

    protected $data_table;
    protected $data_column;
    protected $except_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $table, string $column, int $except_id = null)
    {
        $this->data_table = $table;
        $this->data_column = $column;
        $this->except_id = $except_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        if($this->except_id != null){
            $exists = DB::table($this->data_table)->where($this->data_column,$value)->where('id','!=',$this->except_id)->exists();
        }
        else{
            $exists = DB::table($this->data_table)->where($this->data_column,$value)->exists();
        }

        if($exists){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email has already been taken.';
    }
}
