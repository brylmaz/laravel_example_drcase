FROM redis:latest

ARG REDIS_PASSWORD=secret

RUN mkdir -p /usr/local/etc/redis
COPY redis.conf /usr/local/etc/redis/redis.conf
RUN sed -i "s/__REDIS_PASSWORD__/${REDIS_PASSWORD}/g" /usr/local/etc/redis/redis.conf

VOLUME /src/data

EXPOSE 6379

CMD ["redis-server --appendonly yes", "/usr/local/etc/redis/redis.conf"]