b:
	docker context use default; \
	STAGE=DEV docker-compose -f docker-compose.yml up --build --remove-orphans

deploy:
	docker context use frontrow-production; \
	STAGE=PROD \
	docker-compose -f docker-compose.yml up
	docker-compose -f frontend/docker-compose.yml up --build --remove-orphans

pushB:
	docker context use default; \
	docker tag a742c3a7be47 188547014787.dkr.ecr.us-east-1.amazonaws.com/thechosen-wordpress:prod-latest; \
	docker push 188547014787.dkr.ecr.us-east-1.amazonaws.com/thechosen-wordpress:prod-latest

pushB-tchos:
	docker context use default; \
	docker tag b2780c6a233c 807219464962.dkr.ecr.us-east-1.amazonaws.com/wp-tchos:prod-latest; \
	docker push 807219464962.dkr.ecr.us-east-1.amazonaws.com/wp-tchos:prod-latest