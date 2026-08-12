<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use Illuminate\Http\Request;

class CarCompanyController extends Controller
{
    public function index()
    {
        $companies = CarCompany::orderBy('name', 'asc')->get();
        return view('car_companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:car_companies,name',
        ]);

        CarCompany::create($validated);

        return redirect()->route('car-companies.index')->with('success', 'Car company added successfully!');
    }

    public function update(Request $request, CarCompany $carCompany)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:car_companies,name,' . $carCompany->id,
        ]);

        $carCompany->update($validated);

        return redirect()->route('car-companies.index')->with('success', 'Car company updated successfully!');
    }

    public function destroy(CarCompany $carCompany)
    {
        $carCompany->delete();
        return redirect()->route('car-companies.index')->with('success', 'Car company deleted successfully!');
    }
}
