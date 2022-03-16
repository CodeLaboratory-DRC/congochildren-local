<?php

namespace App\Http\Controllers;

use App\Models\Agricole;
use Illuminate\Http\Request;
use App\Exports\AgricoleExport;
use App\Models\Contact;
use App\Models\Localisation;
use Maatwebsite\Excel\Facades\Excel;


class AgricoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$agricoles = Contact::select(
			'agricoles.id',
			'agricoles.sites_id',
			'agricoles.nom',
			'agricoles.categorisation',
			'agricoles.serviceAgrement',
			'agricoles.nomGerant',
			'agricoles.domaine',
			'agricoles.capaciteProduction',
			'agricoles.users_id',
			'agricoles.is_deleted',
			'contacts.adresse',
			'contacts.telephone',
			'contacts.website',
			'contacts.email'
		)
			->join('agricoles', 'agricoles.id', 'contacts.id_table')
			->where('contacts.nomTable', 'agricoles')
			->where('agricoles.is_deleted', '=', false)
			->orderBy('agricoles.nom')
			->paginate(20);


		return view('agricoles.agricole', compact('agricoles'));
	}

	public function export()
	{
		return Excel::download(new AgricoleExport, 'coopératives_agricoles.xlsx');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Agricole  $agricole
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$agricole = Contact::select(
			'agricoles.id as agricole_id',
			'agricoles.sites_id',
			'agricoles.nom',
			'agricoles.categorisation',
			'agricoles.serviceAgrement',
			'agricoles.nomGerant',
			'agricoles.domaine',
			'agricoles.capaciteProduction',
			'agricoles.users_id',
			'agricoles.is_deleted',
			'contacts.adresse',
			'contacts.telephone',
			'contacts.website',
			'contacts.email'
		)
			->join('agricoles', 'agricoles.id', 'contacts.id_table')
			->where('contacts.nomTable', 'agricoles')
			->where('agricoles.id', $id)
			->where('agricoles.is_deleted', '=', false)
			->first();

		return view('agricoles.agricole_detail', compact('agricole'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Agricole  $agricole
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$agricole = Agricole::join('contacts', 'agricoles.id', 'contacts.id_table')
			->where('agricoles.id', $id)
			->first();

		$productionUnity = $this->getProductionUnity($agricole->domaine);

		return view('agricoles.update', compact('agricole', 'id', 'productionUnity'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Miniere  $miniere
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$validatedData = $request->validate([
			'nom' => 'required',
			'serviceAgrement' => 'required',
			'nomGerant' => 'required',
			'domaine' => 'required',
			'adresse' => 'required',
			'telephone' => 'required',
		]);

		$agricole = Agricole::find($id);
		if ($agricole) {

			$four = $agricole->update([
				'nom' => $request->nom,
				'serviceAgrement' => $request->serviceAgrement,
				'nomGerant' => $request->nomGerant,
				'domaine' => $request->domaine,
				'capaciteProduction' => $request->capaciteProduction ?? '',
				// 'equipement' => $request->equipement ?? '',
				// 'transformation' => $request->transformation ?? '',
			]);

			Contact::where('contacts.nomTable', 'minieres')
				->where('id_table', $id)
				->update([
					'telephone' => $request->telephone,
					'adresse' => $request->adresse,
					'email' => $request->email ?? '',
					'website' => $request->website ?? '',
				]);

			if ($four) {
				return redirect()->route('agricole.list')->withSuccess('Cooperative agricole mis a jour avec succès');
			}
			return redirect()->back()->withInput()->withError('une erreur s\'est produite');
		}
		return redirect()->back()->withInput()->withError('cooperative agricole non existante');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Agricole  $agricole
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($agricole)
	{
		$agricole = Agricole::find($agricole);
		$agricole->is_deleted = true;
		$agricole->save();

		return redirect()->route('agricole.list')->with('success', 'Envoyer a la corbeille avec succès');
	}

	public function restore($agricole)
	{
		$agricole = Agricole::find($agricole);
		$agricole->is_deleted = false;
		$agricole->save();

		return redirect()->route('agricole.bin')->with('success', 'Agricole restauré avec succès');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function bin()
	{
		$agricoles = Contact::select(
			'agricoles.id',
			'agricoles.sites_id',
			'agricoles.nom',
			'agricoles.categorisation',
			'agricoles.serviceAgrement',
			'agricoles.nomGerant',
			'agricoles.domaine',
			'agricoles.capaciteProduction',
			'agricoles.users_id',
			'agricoles.is_deleted',
			'contacts.adresse',
			'contacts.telephone',
			'contacts.website',
			'contacts.email'
		)
			->join('agricoles', 'agricoles.id', 'contacts.id_table')
			->where('contacts.nomTable', 'agricoles')
			->where('agricoles.is_deleted', '=', true)
			->get();


		return view('agricoles.bin', compact('agricoles'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Agricole  $agricole
	 * @return \Illuminate\Http\Response
	 */
	public function destroyDef($agricole)
	{
		$agricole = Agricole::find($agricole);
		Contact::where('id_table', $agricole->id)->where('contacts.nomTable', 'agricoles')->delete();
		Localisation::where('id_table', $agricole->id)->where('localisations.nomTable', 'agricoles')->delete();
		$agricole->delete();

		return redirect()->route('agricole.bin')->withSuccess('Agricole supprimé avec succès');
	}

	public function getProductionUnity($domaine)
	{
		switch ($domaine) {
			case 'Culture maraichère':
				return 'sacs';
				break;
			case 'Culture pérenne':
				return 'sacs';
				break;
			case 'Pisciculture et élevage':
				return 'têtes';
				break;
			default:
				return 'Kg';
				break;
		}
	}
}
