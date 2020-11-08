#Gulf Gas and Power Tech Sample

## Assumptions

* The type for the `meterpoint_id` on the `meterpoint_partner` table should be int as an ID, not a float.
* With no defined standard for the response or sample input I decided to make it match the broker name not the ID since
  the type matches under such instances.
* I've used docker to make it so things are easier to test, I figure this is acceptable.

## What has been done

* Set up symfony in a dockerised environment, the project may be found under `/symfony`.
* Added the sample DB as a dump which should be automatically imported on a `docker-compose up`.
* Wrote a basic endpoint `http://symfony.localhost/api-broker/get-commission` which accepts input in the requested
  format and returns a list of matching broker IDs and commissions.
* Matching brokers will always be returned even if the commission is 0, this was a choice made, removing `WithZeros`
  from `symfony/src/Controller/Broker/ApiBrokerController.php:27` will remove the zeros.

## What has not been done

* There's no index on the broker name because in the sample data there were only 10 brokers and as a result the index
  was slower than a full table scan which is also handy since I can use `%broker%` to match partial matches with no
  performance impact since it's doing a full table scan anyway.  
  Obviously in a real life situation this would not be the case, but for the sake of playing with the data it seemed 
  acceptable.
* There are no unit or integration tests, obviously an integration test would be ideal for the SQL query to fetch the
  results. I don't see any need for a unit test in the current work.

## How to run / test

* Install `docker-compose` - https://docs.docker.com/compose/install/ .
* Run `docker-compose up -d` and wait for all containers to start and the terminal to return.
* Run `docker exec -it php-fpm composer install` to install the composer dependencies for symfony.
* Open the project root in a web browser http://symfony.localhost/ .

## Anything else?

* I have never used symfony before, so I took a few hours on Saturday to run through some tutorials on how to do
  things, which meant a lot of this stuff was googled as it was needed. Hopefully there's no silly errors(and if there
  are it's a chance for my to improve my knowledge of symfony too).
* I wrote the SQL for the DB and tested that before realising that symfony would create the tables with different
  conventions based on the class name meaning I had to do some renaming from the sample SQL sent previously. I hope this
  doesn't cause any confusion.
* Because of differences between versions of symfony this causes routing errors on symfony 2 and 3 with nginx, they're
  fairly easy to sort just by replacing references to `symfony/public` with the relevant paths based on context, but
  I've not tested it with any earlier versions of symfony so please don't hold me accountable if symfony 3 doesn't work.
