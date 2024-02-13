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
	docker tag 19c5e91b0747 188547014787.dkr.ecr.us-east-1.amazonaws.com/thechosen-wordpress:prod-latest; \
	docker push 188547014787.dkr.ecr.us-east-1.amazonaws.com/thechosen-wordpress:prod-latest

pushB-tchos:
	docker context use default; \
	docker tag 19c5e91b0747 807219464962.dkr.ecr.us-east-1.amazonaws.com/wp-tchos:prod-latest; \
	docker push 807219464962.dkr.ecr.us-east-1.amazonaws.com/wp-tchos:prod-latest
login:
	docker context use default; \
	docker login -u AWS -p $(aws ecr get-login-password --region us-east-1) 188547014787.dkr.ecr.us-east-1.amazonaws.com