<?php
namespace PHPAdditions;
class Functions {
	public static function namedArgs($function, array $params) {
		if(!is_string($function))
			return false;
		if(!is_assoc($params)) {
			return $function(...$params);
		} else {
			if(function_exists($function) AND is_callable($function)) {
				$funcparams = (new ReflectionFunction($function))->getParameters();
				$funcparamsn = [];
				foreach($funcparams as $k => $p)
					$funcparamsn[$p->getName()] = $k;

				$funcparams = $funcparamsn;

				foreach($params as $key => $value) {
					if(isset($funcparamsn[$key])) {
						$funcparams[$key] = $value;
					}
				}

				$funcparams = array_values($funcparams);

				return $function(...$funcparams);
			}
		}
	}
}
?>