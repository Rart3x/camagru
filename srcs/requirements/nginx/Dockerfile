FROM nginx:alpine

COPY ./conf/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE  1505

CMD ["nginx", "-g", "daemon off;"]