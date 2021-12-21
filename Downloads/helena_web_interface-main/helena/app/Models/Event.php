<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory;

	protected $fillable = [
		'title', 'start', 'end', 'codice', 'tipoesame'
	];
	/**
	 * 
	 * @return mixed
	 */
	function getFillable()
	{
		return $this->fillable;
	}

	/**
	 * 
	 * @param mixed $fillable 
	 * @return Event
	 */
	function setFillable($fillable): self
	{
		$this->fillable = $fillable;
		return $this;
	}
}

?>