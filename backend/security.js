import {randomBytes,scryptSync,timingSafeEqual,createHash} from 'node:crypto';
export function hashPassword(password){const salt=randomBytes(16).toString('hex');return salt+':'+scryptSync(password,salt,64).toString('hex')}
export function verifyPassword(password,stored){const [salt,key]=stored.split(':');if(!salt||!key)return false;const a=Buffer.from(key,'hex'),b=scryptSync(password,salt,64);return a.length===b.length&&timingSafeEqual(a,b)}
export const digest=t=>createHash('sha256').update(t).digest('hex');
export const token=()=>randomBytes(32).toString('hex');
