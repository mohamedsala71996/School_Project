<?php

namespace App\Livewire;

use App\Models\My_Parent;
use App\Models\ParentAttachment;
use App\Models\Nationalities;
use App\Models\Religion;
use App\Models\Type_Blood;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public $x=true;  
    public $successMessage = '';
    public $catchError;
    public $title="";
    public $attachments=[];
    public $show_table=true;


    public $currentStep = 1,

        // Father_INPUTS
        $Email,$id, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id="";


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationalities::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
            'My_Parents' => My_Parent::all(),
        ]);

    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
            'Email' => 'required|unique:my__parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){

        My_Parent::create([
            'Email' => $this->Email,
            'Password' => Hash::make($this->Password),
            'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
            'National_ID_Father' => $this->National_ID_Father,
            'Passport_ID_Father' => $this->Passport_ID_Father,
            'Phone_Father' => $this->Phone_Father,
            'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
            'Passport_ID_Father' => $this->Passport_ID_Father,
            'Nationality_Father_id' => $this->Nationality_Father_id,
            'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
            'Religion_Father_id' => $this->Religion_Father_id,
            'Address_Father' => $this->Address_Father,

            // Mother_INPUTS
            'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
            'National_ID_Mother' => $this->National_ID_Mother,
            'Passport_ID_Mother' => $this->Passport_ID_Mother,
            'Phone_Mother' => $this->Phone_Mother,
            'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
            'Passport_ID_Mother' => $this->Passport_ID_Mother,
            'Nationality_Mother_id' => $this->Nationality_Mother_id,
            'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
            'Religion_Mother_id' => $this->Religion_Mother_id,
            'Address_Mother' => $this->Address_Mother,
        ]);


        foreach($this->attachments as $attachment){

            ParentAttachment::create([
    
                'file_name'=>$attachment->getClientOriginalName(),
                'parent_id'=>My_Parent::latest()->first()->id
            ]);
            $attachment->storeAs($this->National_ID_Father, $attachment->getClientOriginalName(),"photos");
    
    
        }

        $this->currentStep =1;
        $this->reset();
        $this->successMessage=trans("messages.success");

        
    }

    public function edit($id){

        $this->show_table = false;
        $this->x=false;
        $My_Parent= My_Parent::where("id",$id)->first();
        $this->id = $My_Parent->id;
        $this->Email = $My_Parent->email;
        $this->Password = $My_Parent->password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;
    }

    
    public function firstStepEdit(){

        $this->currentStep = 2;
    }


    public function secondStepEdit(){

        $this->currentStep = 3;
    }

    public function submitEditForm(){

        My_Parent::where("id",$this->id)->update([
            'Email' => $this->Email,
            'Password' => Hash::make($this->Password),
            'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
            'National_ID_Father' => $this->National_ID_Father,
            'Passport_ID_Father' => $this->Passport_ID_Father,
            'Phone_Father' => $this->Phone_Father,
            'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
            'Passport_ID_Father' => $this->Passport_ID_Father,
            'Nationality_Father_id' => $this->Nationality_Father_id,
            'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
            'Religion_Father_id' => $this->Religion_Father_id,
            'Address_Father' => $this->Address_Father,

            // Mother_INPUTS
            'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
            'National_ID_Mother' => $this->National_ID_Mother,
            'Passport_ID_Mother' => $this->Passport_ID_Mother,
            'Phone_Mother' => $this->Phone_Mother,
            'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
            'Passport_ID_Mother' => $this->Passport_ID_Mother,
            'Nationality_Mother_id' => $this->Nationality_Mother_id,
            'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
            'Religion_Mother_id' => $this->Religion_Mother_id,
            'Address_Mother' => $this->Address_Mother,
        ]);


        // foreach($this->attachments as $attachments){

        //     ParentAttachment::create([
    
        //         'file_name'=>$attachments->getClientOriginalName(),
        //         'parent_id'=>My_Parent::latest()->first()->id
        //     ]);
        //     $attachments->storeAs($this->National_ID_Father, $attachments->getClientOriginalName(),"attachments");
    
    
        // }

        $this->currentStep =1;
        $this->reset();
        $this->successMessage=trans("messages.success");

        
    }

    public function destroy($id)
    {
        $My_Parent=My_Parent::where("id",$id)->first();
      $ParentAttachment= ParentAttachment::where("parent_id",$id)->get();
        if($ParentAttachment){
            foreach($ParentAttachment as $attachments){
             ParentAttachment::where("parent_id",$id)->delete();
            Storage::disk('photos')->delete($My_Parent->National_ID_Father.'/'.$attachments->file_name);
            }
          


        }

        $My_Parent->delete();
        session()->flash('add',trans('messages.Delete'));
        redirect("add_parent");
        // echo public_path();


    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    
    public function showformadd()
    {
        $this->show_table = false;
    }

    public function backtoTable()
    {
        $this->show_table = true;
    }




}