<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all the vehicles
        $vehicles = Vehicle::all();

        // Redirect to the vehicles index page
        return view('dashboard.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to the vehicles create page
        return view('dashboard.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'matricule' => 'required|unique:vehicles',
            'model' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new vehicle
        $vehicle = new Vehicle();

        // Start filling the vehicle
        $vehicle->matricule = $request->matricule;
        $vehicle->model = $request->model;

        // Check if the request has a file
        if ($request->hasFile('image')) {

            // Hash the image name and store it in the folder & update the vehicle image
            $image = $request->image;
            $image->store('public/vehicles');
            $vehicle->image = $image->hashName();
        }

        // Save the vehicle
        if ($vehicle->save()) {
            // Redirect to the vehicles index page
            return redirect()->route('vehicles.index')->with('success', 'Véhicule ajouté avec succès');
        } else {
            // Redirect to the vehicles create page
            return redirect()->route('vehicles.create')->with('error', 'Erreur lors de l\'ajout du véhicule');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('dashboard.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('dashboard.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        // Validate the request
        $request->validate([
            'matricule' => 'required|unique:vehicles,matricule,' . $vehicle->id,
            'model' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Start filling the vehicle
        $vehicle->matricule = $request->matricule;
        $vehicle->model = $request->model;

        // Check if the request has a file
        if ($request->hasFile('image')) {

            // Delete the old image if it exists
            if ($vehicle->image) {
                unlink(storage_path('app/public/vehicles/' . $vehicle->image));
            }

            // Hash the image name and store it in the folder & update the vehicle image
            $image = $request->image;
            $image->store('public/vehicles');
            $vehicle->image = $image->hashName();
        }

        // Save the vehicle
        if ($vehicle->save()) {
            // Redirect to the vehicles index page
            return redirect()->route('vehicles.index')->with('success', 'Véhicule modifié avec succès');
        } else {
            // Redirect to the vehicles create page
            return redirect()->route('vehicles.create')->with('error', 'Erreur lors de la modification du véhicule');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        // Delete the vehicle
        if ($vehicle->delete()) {
            // Redirect to the vehicles index page
            return redirect()->route('vehicles.index')->with('success', 'Véhicule supprimé avec succès');
        } else {
            // Redirect to the vehicles index page
            return redirect()->route('vehicles.index')->with('error', 'Erreur lors de la suppression du véhicule');
        }
    }
}
