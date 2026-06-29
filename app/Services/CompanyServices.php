<?php

namespace App\Services;

use App\Models\company;

class CompanyServices {

    // Add And Update Company Data
    public function storeCompanyData($data){
        // Get first company record or create new instance
        $company = Company::first() ?? new Company();

        // Delete old logo if new logo is uploaded
        if (isset($data['logo']) && !empty($company->logo)) {
            $this->deleteCompanyImage($company->logo);
        }

        // Delete old favicon if new favicon is uploaded
        if (isset($data['fav_icon']) && !empty($company->fav_icon)) {
            $this->deleteCompanyImage($company->fav_icon);
        }

        // Fill company data
        $company->fill($data);

        // Save data
        if (!$company->save()) {
            return [
                'success' => false,
                'message' => 'Company data not inserted',
                'status'  => 400
            ];
        }

        return [
            'success' => true,
            'message' => 'Company data inserted successfully',
            'status'  => 200
        ];
    }

    // Get Company
    public function getCompanyData(){
        $company= company::first(); 
        if (!$company) {
            # If Company Data is Exists
            return [
                'success'=>false,
                'message'=>'Company Table is Empty',
                'status'=>400
            ];
        } else {
            # If Company Data is Exists
            return [
                'success'=>true,
                'data'=>$company,
                'status'=>200
            ];
        }
    }

 // Delete Sub Category  Image 
    public function deleteCompanyImage($imageName){
        $path = public_path('Company/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

}