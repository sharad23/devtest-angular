<?php

class PeopleController extends \BaseController {

	/**
	 * Display a listing of people
	 *
	 * @return Response
	 */
	public function index()
	{       

		     $persons = Cache::remember('people',1,function()
				  {
				     return DB::table('people')->get();
				  });

	         echo '<pre>';
	         print_r($persons);
	         echo '</pre>';
	        

	        /* Transaction::chunk(20, function($transactions)
			{
			    foreach ($transactions as $transaction)
			    {
			        //
			        
			    }
			    echo "new lot </br>";
			});

	         echo '<pre>';
	         print_r(DB::getQueryLog());
	         echo '</pre>';
	         */
	         /*$child =  Child::with('institutes')->find(1);

	         echo '<pre>';
	         print_r($child->toArray());
	         echo '</pre>';
             */

	}

	/**
	 * Show the form for creating a new person
	 *
	 * @return Response
	 */
	public function create()
	{
		//return View::make('people.create');
		$persons = Cache::get('people');
		echo '<pre>';
		print_r($persons);
		echo '</pre>';
	}

	/**
	 * Store a newly created person in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Person::create($data);

		return Redirect::route('people.index');
	}

	/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		/*$person = Person::findOrFail($id);

		return View::make('people.show', compact('person'));
		*/

		Cache::flush();
	}

	/**
	 * Show the form for editing the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$person = Person::find($id);

		return View::make('people.edit', compact('person'));
	}

	/**
	 * Update the specified person in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$person = Person::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$person->update($data);

		return Redirect::route('people.index');
	}

	/**
	 * Remove the specified person from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Person::destroy($id);

		return Redirect::route('people.index');
	}

}
