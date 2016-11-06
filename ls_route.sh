#!/bin/bash

if [ ! -e ./route_filter ]; then
	g++ ls_route_filter.cpp -o route_filter
fi

php artisan route:list | ./route_filter
