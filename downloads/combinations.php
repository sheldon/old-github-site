<?php
class Combinations{
  public function combs($comb){
    $ret = array();
    foreach(range(1,count($comb)) as $j) $ret = array_merge($ret, $this->comb($comb, $j));
    return $ret;
  }
  
	//$k = 3; /* The size of the subsets; for {1, 2}, {1, 3}, ... it's 2 */
	//$comb = range(1, $n); /* comb[i] is the index of the i-th element in the combination */
  public function comb($comb, $k){
  	$n = count($comb) + 1; /* The size of the set; for {1, 2, 3, 4} it's 4 */

  	/* get the first combination */
  	$ret[] = $this->get_comb(&$comb, &$k);

  	/* Generate and get all the other combinations */
  	while($this->next_comb(&$comb, &$k, &$n))
  		$ret[] = $this->get_comb(&$comb, &$k);

  	return $ret;
  }
  
  /* gets out a combination like {1, 2} */
  private function get_comb($comb, $k){
    $ret_array = array();
  	for($i = 0; $i < $k; ++$i) $ret_array[] = $comb[$i];
    return $ret_array;
  }

  /*
  	next_comb(int comb[], int k, int n)
  		Generates the next combination of n elements as k after comb

  	comb => the previous combination ( use (0, 1, 2, ..., k) for first)
  	k => the size of the subsets to generate
  	n => the size of the original set

  	Returns: 1 if a valid combination was found
  		0, otherwise
  */
  private function next_comb($comb, $k, $n){
  	$i = $k - 1;
  	++$comb[$i];
  	while (($i >= 0) && ($comb[$i] >= $n - $k + 1 + $i)){
  		--$i;
  		++$comb[$i];
  	}

  	if($comb[0] > $n - $k) /* Combination (n-k, n-k+1, ..., n) reached */
  		return 0; /* No more combinations can be generated */

  	/* comb now looks like (..., x, n, n, n, ..., n).
  	Turn it into (..., x, x + 1, x + 2, ...) */
  	for ($i = $i + 1; $i < $k; ++$i)
  		$comb[$i] = $comb[$i - 1] + 1;

  	return 1;
  }
}?>