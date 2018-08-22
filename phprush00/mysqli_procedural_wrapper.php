<?php
/**	Procedural mysqli libriary wrapper that easies life of usage of predefined statements
*** and regular query executions.
*** LICENSE: FREE TO USE/MODIFY/EXTEND FOR ALL CADETS(CURRENT) 42 Sillicon Valley Students
*** LICENSE CONDITION FOR ALL USERS:
*** LICENSE HAS TO BE PRESENT ON ALL COPIES AND DISTRIBITUIONS NO MATTER OF AFFILIATION
*** Maksud Aghayev 2018
********************************************************************************
*** TO DO:
*** Implement:
**** db_bind_result
**/
/** Open a new connection to the MySQL server
** Setting to connect to your DB. Changebale
** @param string host to use to connect to MySQL DB. If not specified default (localhost or 127.0.0.1) assumed
** @param string user to use to connect to MySQL DB. Required.
** @param string password to use to connect to MySQL DB. If not provided or NULL,
** the MySQL server will attempt to authenticate the user against those user records which have no password only.
** This allows one username to be used with different permissions (depending on if a password is provided or not).
** @param string db to use after connecting to MySQL DB.
** If provided will specify the default database to be used when performing queries.
** If not specifed and desired DB is not default one, you can use db_select_db to change it. Optional.
** @param int port to use to connect to MySQL DB. Specifies the port number to attempt to connect to the MySQL server. Optional.
** @return mysqli return object which represents the connection to a MySQL Server.
**/
$host 		=	'127.0.0.1';
$user		=	'root';
$password 	=	'root';
$db 		=	'store_db';
$port 		=	8889;
// Create connection
$conn = mysqli_connect(
	$host,
	$user,
	$password,
	$db,
	$port
);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/******************************************************************************/
/***********************	Connection Funtions    ****************************/
/******************************************************************************/
	/**
	** Changes default DB. Should be use ONLY to change default DB.
	** Preferably to use mysqli_connect and set 4th parameter to use desired DB.
	** Returns bool. True on success and false on failure
	** @param string dbname
	** @return bool true on success and false on failure
	**/
	function db_select_db (string $dbname) {
		global $conn;
		return mysqli_select_db($conn, $dbname);
	}
	/**
	** Number of affected rows using connection
	** @return int num rows
	**/
	function db_affected_rows() {
		global $conn;
		return mysqli_affected_rows($conn);
	}
	/**
	** Closes DB connection
	** @param string dbname
	** @return void
	**/
	function db_close() {
		global $conn;
		return mysqli_close($conn);
	}
/******************************************************************************/
/***************	Query and Data Manipulation Functions	*******************/
/******************************************************************************/
	/** Bind Array Params and Array Types to Prepared Statement
	** Prepares prepared statement and binds parameters passed as array,
	** and parses array of types of each parameter in order of appearance.
	** Triggers error if was not able to prepare a statement and fatals.
	** Returns numeric array that can be used in list() on recieving end, or as is.
	** Index 0 contains status of statement execution
	** Index 1 contains prepared statement that was generated here for further use
	** Use case: to fetch data somewhere else.
	** DOES NOT FETCH DATA.
	** Supported types:
	** s - string
	** i - integer
	** d - double
	** b - blob and will be sent in packets (For use with big data that can chunked)
	** @param string SQL statement
	** @param array types (s - string)
	** @param mixed data to bind
	** @return array array<int, mixed> array[bool, mysqli_stmt]
	**/
	function db_stmt_bind_params_execute(
		string	$sql_string,
		array	$types,
		array	$bind_params
	) {
		global $conn;
		$a_params = array();
		$param_type = '';
		$param_count = count($types);
		for($i = 0; $i < $param_count; $i++)
			$param_type .= $types[$i];
		$a_params[] = & $param_type;
		$bind_params = array_values($bind_params);
		for($i = 0; $i < $param_count; $i++) {
			/* with call_user_func_array, array params must be passed by reference */
			$a_params[] = & $bind_params[$i];
		}
		/* Prepare statement */
		$stmt = db_stmt_prepare($sql_string);
		if($stmt === false) {
		  trigger_error(
			  'Wrong SQL: ' . $sql_string . ' Error: ' . mysqli_errno() . ' ' . mysqli_error(), E_USER_ERROR
		  );
		}
		/* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
		call_user_func_array(array($stmt, 'bind_param'), $a_params);
		/* Execute statement */
		return array(
			db_stmt_sql_exec($stmt),
			$stmt
		);
	}

	function db_select(string $sql)
	{
		global $conn;
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

/******************************************************************************/
/***********************	Fetchers/mysqli_result	  *************************/
/******************************************************************************/
	/** Fetch Array of Rows from Resultset
	** Returns an array that corresponds to the fetched row
	** or NULL if there are no more rows for the resultset represented by the result parameter.
	** db_fetch_array() is an extended version of the db_fetch_row() function.
	** In addition to storing the data in the numeric indices of the result array, the
	** db_fetch_array() function can also store the data in associative indices,
	** using the field names of the result set as keys.
	**
	** Note: Field names returned by this function are case-sensitive.
	** Note: This function sets NULL fields to the PHP NULL value.
	** Note: If two or more columns of the result have the same field names,
	** the last column will take precedence and overwrite the earlier data.
	**
	** In order to access multiple columns with the same name, the numerically indexed version of the row must be used.
	**
	** Usage:
	** Numeric array
	**	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	**	printf ("%s (%s)\n", $row[0], $row[1]);
	**
	** Associative array
	**	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	**	printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
	**
	** Associative and numeric array
	**	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	**	printf ("%s (%s)\n", $row[0], $row["CountryCode"]);
	**
	**
	** @param mysqli_result A result set identifier returned by:
	** mysqli commands: mysqli_query(mysqli $link), mysqli_store_result(mysqli $link) or mysqli_use_result(mysqli $link).
	** This lib commands: db_get_results(mysqli_stmt $stmt)
	** @param int resulttype
	*** This optional parameter is a constant indicating what type of array should be produced from the current row data.
	*** The possible values for this parameter are the constants MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH.
	*** MYSQLI_ASSOC constant - behave identically to the mysqli_fetch_assoc() or db_fetch_assoc(),
	*** MYSQLI_NUM constant   - behave identically to the mysqli_fetch_row()   or db_fetch_row(),
	*** MYSQLI_BOTH will create a single array with the attributes of both.
	**
	** @return array<string> Returns an array of strings that corresponds to the fetched row
	** @return NULL if there are no more rows in result set.
	**/
	function db_fetch_array(
		mysqli_result $result,
		int $resulttype = MYSQLI_ASSOC
	) {
		return mysqli_fetch_row($result);
	}
	/** Fetch One Row from Resultset
	** Fetches one row of data from the result set and returns it as an enumerated array,
	** where each column is stored in an array offset starting from 0 (zero).
	** Each subsequent call to this function will return the next row within the result set,
	** or NULL if there are no more rows.
	** Note: This function sets NULL fields to the PHP NULL value.
	** Usage:
	** Loop - while ($row = mysqli_fetch_row())
	**
	** @param mysqli_result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
	** @return array<string> Returns an array of strings that corresponds to the fetched row
	** @return NULL if there are no more rows in result set.
	**/
	function db_fetch_row( mysqli_result $result ) {
		return mysqli_fetch_row($result);
	}
	/** Fetch a result row as an associative array
	** Returns an associative array that corresponds to the fetched row or NULL if there are no more rows.
	** Each key in the array represents the name of one of the result set's columns or NULL if there are no more rows in resultset.
	** If two or more columns of the result have the same field names, the last column will take precedence.
	** More info: http://php.net/manual/en/mysqli-result.fetch-all.php
	**
	** Note: Field names returned by this function are case-sensitive.
	** Note: This function sets NULL fields to the PHP NULL value.
	** Usage:
	** Loop -  while ($row = db_fetch_assoc(mysqli_result $result))
	**
	** @param mysqli_result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
	** @return array<string> Returns an array of strings that corresponds to the fetched row
	** @return NULL if there are no more rows in result set.
	**/
	function db_fetch_assoc(mysqli_result $result) {
		return mysqli_fetch_assoc($result);
	}
	/** Fetches all result rows as an associative array, a numeric array, or both
	** Supported resulttypes:
	**	MYSQLI_ASSOC
	**	MYSQLI_NUM
	**	MYSQLI_BOTH
	**
	** @param mysqli_result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
	** @param 			int	resulttype const
	** @return array array<string | int, mixed>
	**/
	function db_fetch_all(mysqli_result $result, int $resulttype = MYSQLI_ASSOC)
	{
		return mysqli_fetch_all($result, $resulttype);
	}
	/**
	** Frees the memory associated with the result.
	** You should always free your result with mysqli_free_result(), when your result object is not needed anymore.
	** @param mysqli_result A result set identifier returned by:
	** mysqli commands: mysqli_query(mysqli $link), mysqli_store_result(mysqli $link) or mysqli_use_result(mysqli $link).
	** This lib commands: db_get_results(mysqli_stmt $stmt)
	** @return void
	**/
	function db_free_result(mysqli_result $result) {
		mysqli_free_result($result);
	}

/******************************************************************************/
/***************************	Prepared Statement	   ************************/
/******************************************************************************/
	/**
	** Creates prepared statement array based on string sql query
	** Returns bool. True on success and false on failure
	** @param string SQL query
	** @return mysqli_stmt or false on failure
	**/
	function db_stmt_prepare(string $sql_string) {
		global $conn;
		return mysqli_prepare(
			$conn,
			$sql_string
		);
	}
	/**
	** Binds parameter and type to prepared statement
	** Returns bool. True on success and false on failure
	** @param mysqli_stmt mysqli_statement
	** @param string type
	** @param mixed data to bind
	** @return bool
	**/
	function db_stmt_bind_param (
		mysqli_stmt	$stmt,
		string		$type,
					$param
	) {
		return mysqli_stmt_bind_param(
			$stmt,
			$type,
			$param
		);
	}
	/**
	** Executes statement
	** Returns bool. True on success and false on failure
	** @param mysqli_stmt mysqli_statement
	** @return bool
	**/
	function db_stmt_sql_exec(mysqli_stmt $stmt) {
		return (mysqli_stmt_execute($stmt));
	}
	/** Statement Result to mysqli_result
	** Call to return a result set from a prepared statement query.
	** Returns a resultset for successful SELECT queries, or FALSE for other DML queries or on failure.
	** The mysqli_errno() function can be used to distinguish between the two types of failure.
	** Usage:
	**	Pre-Loop - $result = db_stmt_get_result($stmt);
	**	Loop - while ($row = db_fetch_array($result, MYSQLI_NUM))
	**
	** @param	mysqli_stmt		statement
	** @return	mysqli_result	resultset
	** @return bool false only
	**/
	function db_stmt_get_result(mysqli_stmt $stmt) {
		return mysqli_stmt_get_result($stmt);
	}
	/** Fetch Row from Predefined Statement - NOT FULLY READY. MISSING db_bind_result!
	** Fetch the result from a prepared statement into the variables bound by db_bind_result()
	**
	** Note: All columns must be bound by the application before calling db_stmt_fetch().
	** Note: Data are transferred unbuffered without calling mysqli_stmt_store_result()
	** which can decrease performance (but reduces memory cost).
	** Usage:
	**	Loop - while (db_stmt_fetch(mysqli_stmt))
	**
	** @param mysqli_stmt mysqli_statement
	** @return bool TRUE - Success. Row fetched. FALSE - Error occured
	** @return NULL if there are no more rows in result set.
	**/
	function db_stmt_fetch(mysqli_stmt $stmt) {
		return mysqli_stmt_fetch($stmt);
	}
	/** Statement Result to mysqli_result
	** Returns the number of rows affected by INSERT, UPDATE, or DELETE query.
	** This function only works with queries which update a table.
	** In order to get the number of rows from a SELECT query, use db_stmt_num_rows() instead.
	** Note: If the number of affected rows > max PHP int value, the number of affected rows will be returned as a string value.
	**
	** @param	mysqli_stmt	statement
	** @return int resultset
	** @return int An integer greater than zero indicates the number of rows affected or retrieved.
	** @return int Zero indicates that no records where updated for an UPDATE/DELETE statement,
	***	no rows matched the WHERE clause in the query or that no query has yet been executed.
	** @return int -1 indicates that the query has returned an error.
	** @return NULL indicates an invalid argument was supplied to the function.
	**/
	function db_stmt_affec_rows(mysqli_stmt $stmt) {
		return mysqli_stmt_affected_rows($stmt);
	}

?>
